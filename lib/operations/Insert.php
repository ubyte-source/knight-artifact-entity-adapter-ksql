<?PHP

namespace KSQL\operations;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\adapters\map\Injection;
use KSQL\operations\common\Handling;

/* It takes a list of tables, and returns a list of queries */

class Insert extends Handling
{
    protected $ignore = false; // (bool)
    protected $update = false; // (bool)

    /**
     * It takes a list of tables, and returns a list of queries
     * 
     * @return An array of queries.
     */

    public function getQueries() : array
    {
        $core = $this->getCore();
        $core_connection = $core->getConnection();
        $core_connection_dialect = $core_connection->getDialect();

        $skip = $this->getSkip();
        $skip = array_map(function (Table $table) {
            return $table->getHash();
        }, $skip);

        $tables = $core->getTable();
        $tables = static::tables($core_connection_dialect, $tables, static::class, ...$skip);
        foreach ($tables as $query) {
            $table = $query->getTable();

            $statement = new Statement($core_connection);
            $statement->append('INSERT');

            if ($this->getIgnore()) $statement->append('IGNORE');

            $statement->append('INTO');
            $statement_table = $table->getCollectionName();
            $statement->append(chr(96) . $statement_table . chr(96));

            $table_injection = $table->getInjection();
            $table_injection_columns = $table_injection->getColumnsParsed(Injection::CLEAN);

            $statement->pushFromBind($table_injection);

            $table_columns = $table->getAllFieldsValues(true, false);
            $table_columns = array_diff_key($table_columns, $table_injection_columns);

            $table_columns_bind = array_merge($table_injection_columns, $table_columns);
            $table_columns_bind = array_unique(array_keys($table_columns_bind), SORT_STRING);
            $table_columns_bind = preg_filter('/^.*$/', chr(96) . '$0' . chr(96), $table_columns_bind);
            $table_columns_bind = implode(chr(44) . chr(32), $table_columns_bind);

            $statement->append(chr(40) . $table_columns_bind . chr(41));
            $statement->append('VALUES');

            array_walk($table_columns, function (&$value) use ($statement) {
                $value = null === $value ? 'NULL' : chr(58) . current($statement->getBound($value));
            });
            $table_columns_bind = $table_injection_columns + $table_columns;
            $table_columns_bind_values = implode(chr(44) . chr(32), $table_columns_bind);
            $statement->append(chr(40) . $table_columns_bind_values . chr(41));

            if ($this->getUpdate()) {
                $statement->append('ON DUPLICATE KEY UPDATE');
                array_walk($table_columns_bind, function (&$value, $key) {
                    $value = chr(96) . $key . chr(96) . chr(32) . '=' . chr(32) . $value;
                });
                $table_columns_bind_values = implode(chr(44) . chr(32), $table_columns_bind);
                $statement->append($table_columns_bind_values);
            }

            $query->setStatement($statement);
        }

        return $tables;
    }

    /**
     * The setUpdate function sets the update property to the value passed in
     * 
     * @param bool value The value to set the property to.
     * 
     * @return The object itself.
     */

    public function setUpdate(bool $value = true) : self
    {
        $this->update = $value;
        return $this;
    }

    /**
     * Returns true if the update flag is set.
     * 
     * @return A boolean value.
     */

    public function getUpdate() : bool
    {
        return $this->update === true;
    }

    /**
     * Set the ignore flag to true or false.
     * 
     * @param bool value The value to set the property to.
     * 
     * @return Nothing.
     */

    public function setIgnore(bool $value = true) : self
    {
        $this->ignore = $value;
        return $this;
    }

    /**
     * Get the value of the ignore property.
     * 
     * @return A boolean value.
     */

    public function getIgnore() : bool
    {
        return $this->ignore === true;
    }
}
