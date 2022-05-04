<?PHP

namespace KSQL\operations;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\dialects\constraint\Dialect;
use KSQL\adapters\map\Injection;
use KSQL\operations\select\Join;
use KSQL\operations\select\Group;
use KSQL\operations\select\Order;
use KSQL\operations\select\Limit;
use KSQL\operations\select\Alias;
use KSQL\operations\common\Base;
use KSQL\operations\common\features\Where;
use KSQL\connection\Common as Connection;

/* It takes a list of tables, and returns a list of queries */

class Select extends Base
{
    use Where;

    protected $join = []; // (array)
    protected $distinct;  // (bool)
    protected $from;      // Statement
    protected $injection; // Injection
    protected $group;     // Group
    protected $order;     // Order
    protected $limit;     // Limit
    protected $alias;     // Alias

    /**
     * Returns the name of the table
     * 
     * @param Table table The Table object that we're getting the table name for.
     * @param alias The alias of the table.
     * 
     * @return The table name.
     */

    public static function getTableName(Table $table, ?Alias $alias = null) : string
    {
        $name = $table->getCollectionName();
        if (null !== $alias) $name = $alias->getName();
        $name = chr(96) . $name . chr(96);
        return $name;
    }

    /**
     * Add a join to the query
     * 
     * @return The same object.
     */

    public function pushJoin(Join ...$join) : self
    {
        if (!!$join) array_push($this->join, ...$join);
        return $this;
    }

    /**
     * Returns the join array
     * 
     * @return An array of the join statements.
     */

    public function getJoin() : array
    {
        return $this->join;
    }

   /**
    * Find a join in the current query by table hash
    * 
    * @param Table table The table to join.
    * 
    * @return A Join object or null.
    */

    public function findJoin(Table $table) :? Join
    {
        $joins = $this->getJoin();
        $table_hash = $table->getHash();
        foreach ($joins as $item)
            if ($table_hash === $item->getTable()->getHash())
                return $item;
        return null;
    }

    /**
     * The setDistinct method sets the distinct property to the value passed in
     * 
     * @param bool distinct If set to true, the query will be executed with a distinct clause.
     * 
     * @return The current instance of the class.
     */

    public function setDistinct(bool $distinct = true) : self
    {
        $this->distinct = $distinct;
        return $this;
    }

    /**
     * Get the injection for this object.
     * 
     * @return The injection object.
     */

    public function getInjection() : Injection
    {
        return $this->injection;
    }

    /**
     * Get the group that this user belongs to.
     * 
     * @return The group object that is associated with the question.
     */

    public function getGroup() : Group
    {
        return $this->group;
    }

    /**
     * Get the order object.
     * 
     * @return The Order object that is associated with the OrderItem.
     */

    public function getOrder() : Order
    {
        return $this->order;
    }

    /**
     * Get the limit.
     * 
     * @return The limit object.
     */

    public function getLimit() : Limit
    {
        return $this->limit;
    }

    /**
     * Creates a new Alias object and sets it as the current alias for this QueryBuilder
     * 
     * @param string name The name of the alias.
     * 
     * @return The current instance of the class.
     */

    public function useAlias(string $name = null) : self
    {
        $table = $this->getTable();
        $this->alias = new Alias($table);
        if (null !== $name) $this->alias->setName($name);
        return $this;
    }

    /**
     * Get the alias of this object.
     * 
     * @return The alias object.
     */

    public function getAlias() :? Alias
    {
        return $this->alias;
    }

    /**
     * The setFromStatement function sets the from property of the class to the given statement
     * 
     * @param Statement statement The statement to be used as the FROM clause.
     * 
     * @return The object itself.
     */

    public function setFromStatement(Statement $statement) : self
    {
        $this->from = $statement;
        return $this;
    }

    /**
     * Returns the table object for the current model
     * 
     * @return A Table object.
     */

    public function getTable() : Table
    {
        return $this->getCore()->getTable();
    }

    /**
     * Returns the connection object for the current request
     * 
     * @return A connection object.
     */

    public function getConnection() :? Connection
    {
        return $this->getCore()->getConnection();
    }

    /**
     * Given a table, return the field name
     * 
     * @param Table table The table to get the field from.
     * @param string name The name of the field to get.
     * 
     * @return The field name.
     */

    public function getFieldParsed(Table $table, string $name) : string
    {
        $master = $this->getTable();
        if ($table === $master) {
            $table_name = $this->getFrom();
            $field_name = $table_name . chr(46) . chr(96) . $name . chr(96);
            return $field_name;
        }

        $join = $this->findJoin($table);
        if (null !== $join) return $join->getFieldParsed($name);

        $field_name = $table->getFieldPath($name);
        return $field_name;
    }

    /**
     * This function returns the table name of the current model
     * 
     * @return The table name.
     */

    public function getFrom() : string
    {
        return static::getTableName($this->getTable(), $this->getAlias());
    }

    /**
     * This function returns a statement object that contains the SQL query that will be executed by
     * the database
     * 
     * @return The SQL statement.
     */

    public function getStatement() : Statement
    {
        $statement_connection = $this->getConnection();
        $statement_connection_dialect = $statement_connection->getDialect();
        $statement = new Statement($statement_connection);
        $statement->append('SELECT');

        if ($this->getDistinct()) $statement->append('DISTINCT');

        $table = $this->getTable();

        $statement_columns_group = $this->getGroup();
        $statement_columns = $this->getAllColumns($statement_connection_dialect, $table, true, $statement_columns_group);

        array_walk($statement_columns, function (&$value, $key) {
            $value = $value . chr(32) . 'AS' . chr(32) . chr(96) . $key . chr(96);
        });

        $statement_injection = $this->getInjection();
        $statement_injection_columns = $statement_injection->getColumnsParsed(Injection::FIELD);
        if (!!$statement_injection_columns) {
            $statement_columns = array_merge($statement_columns, $statement_injection_columns);
            $statement->pushFromBind($statement_injection);
        }

        $statement_columns = implode(chr(44) . chr(32), $statement_columns);
        $statement->append($statement_columns);

        $statement->append('FROM');
        $statement_from = $this->getFromStatement();
        if (null !== $statement_from) {
            $statement_from_sintax = $statement_from->get();
            $statement_from_sintax = chr(40) . $statement_from_sintax . chr(41);
            $statement->append($statement_from_sintax);
            $statement->append('AS');
            $statement->pushFromBind($statement_from);
            $statement->append($statement_from);
        } else {
            $statement_from = $this->getFrom();
            $statement_table_name = static::getTableName($table);
            $statement->append($statement_table_name);
            if ($statement_table_name !== $statement_from) {
                $statement->append('AS');
                $statement->append($statement_from);
            }
        }

        if ($statement_join = $this->join($statement_connection_dialect, $table)) {
            $statement_join = implode(chr(32), $statement_join);
            $statement->append($statement_join);
        }

        $table_clone = clone $table;
        $table_clone->cloneHashEntity($table);
        $table_clone_fields = $table_clone->getFields();
        foreach ($table_clone_fields as $field) $field->setProtected(false);

        if ($statement_where = $this->where($statement_connection_dialect, $table_clone)) {
            $statement_where_sintax = $statement_where->get();
            if (0 !== strlen($statement_where_sintax)) {
                $statement->append('WHERE');
                $statement->append($statement_where->get());
                $statement->pushFromBind($statement_where);
            }
        }

        if ($statement_group_columns = $statement_columns_group->getColumns($this)) {
            $statement->append('GROUP BY');
            $statement_group_columns_sintax = implode(chr(44) . chr(32), $statement_group_columns);
            $statement->append($statement_group_columns_sintax);

            $statement_columns_group_having = $statement_columns_group->getHaving();
            if (null !== $statement_columns_group_having) {
                $statement->append('HAVING');
                $statement->append($statement_columns_group_having);
            }
        }

        $statement->pushFromBind($statement_columns_group);

        if ($statement_order_columns = $this->getOrder()->getColumns($this)) {
            $statement->append('ORDER BY');
            $statement_order_columns_sql = implode(chr(44) . chr(32), $statement_order_columns);
            $statement->append($statement_order_columns_sql);
        }

        $this->shouldLimit($statement);

        return $statement;
    }

    /**
     * This function runs the statement that was created in the constructor
     * 
     * @return The statement object.
     */

    public function run()
    {
        return $this->getStatement()->execute();
    }

    /**
     * This function will return all the columns from the table and all the joined tables
     * 
     * @param Dialect dialect The dialect to use for the query.
     * @param Table data The table that we are getting the columns from.
     * @param bool required If true, the column is required to be in the query.
     * @param Group group The group to which the columns belong.
     * 
     * @return The columns that are being returned are the columns that are being used in the query.
     *     This includes the columns that are being joined.
     */

    public function getAllColumns(Dialect $dialect, Table $data, bool $required = false, Group $group = null) : array
    {
        $join = $data->getJoinedTables()->getTables();
        $alias = $this->getAlias();
        $columns_response = static::buildColumns($dialect, $data, $alias, $required, $group);

        foreach ($join as $table) {
            $alias = $this->findJoin($table);
            if (null !== $alias) $alias = $alias->getAlias();
            $columns_response += static::buildColumns($dialect, $table, $alias, $required, $group);
            $columns_response += $this->getAllColumns($dialect,
                $table,
                $required,
                $group);
        }

        return $columns_response;
    }

    /**
     * It builds the columns for the SELECT statement
     * 
     * @param Dialect dialect The dialect to use.
     * @param Table table The table object.
     * @param alias The alias of the table.
     * @param required If true, only the fields that are required will be included in the query.
     * @param group The group of columns to be included in the query.
     * 
     * @return The method returns an array of columns that will be used to build the query.
     */

    protected static function buildColumns(Dialect $dialect, Table $table, ?Alias $alias = null, ?bool $required = false, ?Group $group = null) : array
    {
        $group_columns = $group === null ? [] : $group->getColumns(null, true);

        $table_columns = $table->getAllFieldsKeys();
        $table_columns_files = $table->getAllFieldsFileName();
        $table_columns = array_diff($table_columns, $table_columns_files);
        if (true === $required) $table_columns = array_intersect($table_columns, $table->getAllFieldsRequiredName());

        $table_name = static::getTableName($table, $alias);
        $sql_filter = $table_name . chr(46) . chr(96) . '$0' . chr(96);
        $sql_filter_field = empty($group_columns)
            ? $sql_filter
            : $dialect::AnyValue($sql_filter);
        $sql = preg_filter('/^.*$/', $sql_filter_field, $table_columns);
        $sql = array_combine($table_columns, $sql);

        if (true === $required) $table_columns_files = array_intersect($table_columns_files, $table->getAllFieldsRequiredName());

        $table_columns_files_sintax = $dialect::FileReplacer($sql_filter_field);
        if (null !== $table_columns_files_sintax) {
            $table_columns_files_sintax = preg_filter('/^.*$/', $table_columns_files_sintax, $table_columns_files);
            $table_columns_files_sintax = array_combine($table_columns_files, $table_columns_files_sintax);
            $sql = array_merge($sql, $table_columns_files_sintax);
        }

        if ($group_intersect = array_intersect($group_columns, $table_columns)) {
            $group_intersect_sintax = preg_filter('/^.*$/', $sql_filter, $group_intersect);
            $group_intersect_sintax = array_combine($group_intersect, $group_intersect_sintax);
            $sql = array_merge($sql, $group_intersect_sintax);
        }

        return $sql;
    }

    /**
     * The initialize function sets the group, order, limit, and injection properties to new instances
     * of their respective classes
     */

    protected function initialize() : void
    {
        $this->setGroup(new Group());
        $this->setOrder(new Order());
        $this->setLimit(new Limit());
        $this->setInjection(new Injection());
    }

    /**
     * The setInjection function sets the injection property to the injection parameter
     * 
     * @param Injection injection The injection to be used.
     */

    protected function setInjection(Injection $injection) : void
    {
        $this->injection = $injection;
    }

    /**
     * The setGroup function sets the group property to the given Group object
     * 
     * @param Group group The group that the user is being added to.
     */

    protected function setGroup(Group $group) : void
    {
        $this->group = $group;
    }

    /**
     * The setOrder function takes an Order object as a parameter and sets the order property to that
     * object
     * 
     * @param Order order The order object.
     */

    protected function setOrder(Order $order) : void
    {
        $this->order = $order;
    }

    /**
     * The setLimit function sets the limit property of the class to the limit parameter
     * 
     * @param Limit limit The limit of the number of records to return.
     */

    protected function setLimit(Limit $limit) : void
    {
        $this->limit = $limit;
    }

    /**
     * Returns true if the query is a distinct query
     * 
     * @return A boolean value.
     */

    protected function getDistinct() : bool
    {
        return $this->distinct === true;
    }

    /**
     * The setJoin function takes an array of Join objects and sets the join property of the current
     * object to that array
     */

    protected function setJoin(Join ...$join) : void
    {
        $this->join = $join;
    }

    /**
     * This function should limit the number of rows returned by the statement
     * 
     * @param Statement statement The statement to limit.
     */

    protected function shouldLimit(Statement $statement) : void
    {
        $statement_connection = $statement->getConnection();
        $statement_connection_dialect = $statement_connection->getDialect();
        $statement_connection_dialect::Limit($statement, $this->getLimit());
    }

    /**
     * Get the from statement.
     * 
     * The summary should be written in the imperative. It should be short and to the point, but should
     * contain the most important information about the function
     * 
     * @return A Statement object.
     */

    protected function getFromStatement() :? Statement
    {
        return $this->from;
    }

    /**
     * It takes a Dialect object and a Table object, and returns an array of strings
     * 
     * @param Dialect dialect The dialect to use.
     * @param Table data The data object that is being joined.
     * 
     * @return The join method is returning an array of strings.
     */

    protected function join(Dialect $dialect, Table $data) : array
    {
        $response = [];
        $tables = $data->getJoinedTables()->getTables();
        if (null === $tables
            || empty($tables)) return $response;

        $join_constant = Join::getConstants(Join::class);

        foreach ($tables as $table) {

            $join = $this->findJoin($table);

            if (null === $join || empty($join->getConditions())) {
                $table_name = $table->getCollectionName();
                $table_name_joined = $dialect::NaturalJoin($table_name);
                array_push($response, $table_name_joined);
            } else {
                $sql = [];

                $join_type = $join->getType();
                $join_type_constant = array_search($join_type, $join_constant, true);
                if (false !== $join_type_constant
                    && Join::INNER !== $join_type) array_push($sql, $join_type_constant);

                $join_table = $join->getTable()->getCollectionName();
                $join_alias = $join->getAlias()->getName();
                $join_alias = 'JOIN' . chr(32) . chr(96) . $join_table . chr(96) . chr(32) . 'AS' . chr(32) . chr(96) . $join_alias . chr(96);
                array_push($sql, $join_alias);

                $join_conditions = $join->getConditionsBuilded();
                if (null !== $join_conditions) array_push($sql, $join_conditions);

                array_push($response, implode(chr(32), $sql));
            }

            if (!!$table_response = $this->join($dialect, $table)) array_push($response, ...$table_response);
        }

        return array_unique($response, SORT_REGULAR);
    }
}