<?PHP

namespace KSQL\operations\select;

use KSQL\entity\Table;
use KSQL\operations\select\Alias;
use KSQL\operations\common\Option;

/* This class is used to join tables */

class Join extends Option
{
    const RIGHT = 0x830b82;
    const INNER = 0x830c84;
    const LEFT = 0x830a80;

    protected $type;                 // (int)
    protected $conditions = [];      // (array)
    protected $using = false;        // (array)
    protected $alias;                // Alias

    /**
     * Constructor for the inner join
     * 
     * @param Table table The table object that is being joined.
     */

    public function __construct(Table $table)
    {
        parent::__construct($table);
        $this->setType(static::INNER);
        $this->setAlias();
    }

    /**
     * Set the type of join.
     * 
     * @param int type The type of join.
     * 
     * @return Nothing.
     */

    public function setType(int $type) : self
    {
        $constants = static::getConstants(static::class);
        if (false === in_array($type, $constants)) throw new CustomException('developer/database/ksql/operations/select/join/type');
        $this->type = $type;
        return $this;
    }

    /**
     * Get the type of the object
     * 
     * @return The type of the question.
     */

    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Add a condition to the query
     * 
     * @param string condition The condition to add to the query.
     * 
     * @return The object itself.
     */

    public function addCondition(string $condition) : self
    {
        array_push($this->conditions, $condition);
        return $this;
    }

    /**
     * Returns the conditions array
     * 
     * @return An array of conditions.
     */

    public function getConditions() : array
    {
        return $this->conditions;
    }

    /**
     * This function returns the conditions that are used in the ON statement
     * 
     * @return The conditions that are being used in the join.
     */

    public function getConditionsBuilded() :? string
    {
        $conditions = $this->getConditions();
        $conditions_list = $this->getUsingList();
        if (true === $conditions_list) {
            $conditions = preg_filter('/^.*$/', chr(96) . '$0' . chr(96), $conditions);
            $conditions = implode(chr(44) . chr(32), $conditions);
            $conditions = 'USING' . chr(40) . $conditions . chr(41);
            return $conditions;
        }

        $conditions = implode(chr(32) . 'AND' . chr(32), $conditions);
        $conditions = 'ON' . chr(32) . $conditions;
        return $conditions;
    }

    /**
     * The setUsingList function sets the using property to the value of the enable parameter
     * 
     * @param bool enable If true, the list will be used. If false, the list will be ignored.
     * 
     * @return Nothing.
     */

    public function setUsingList(bool $enable = true) : self
    {
        $this->using = $enable;
        return $this;
    }

    /**
     * Returns the value of the using property
     * 
     * @return A boolean value.
     */

    public function getUsingList() : bool
    {
        return $this->using;
    }

    /**
     * Get the alias of this joined table.
     * 
     * @return The Alias joined table.
     */

    public function getAlias() : Alias
    {
        return $this->alias;
    }

    /**
     * Returns the name of the field in the table, with the table alias prepended
     * 
     * @param string name The name of the field to be parsed.
     * 
     * @return The field name with the table alias.
     */

    public function getFieldParsed(string $name) : string
    {
        $table_alias = $this->getAlias()->getName();
        $table_alias = chr(96) . $table_alias . chr(96);

        $table = $this->getTable();
        $table_field = $table->getField($name);
        $table_field_name = $table_field->getName();
        $table_field_name = chr(96) . $table_field_name . chr(96);
        $table_field_name = $table_alias . chr(46) . $table_field_name;

        return $table_field_name;
    }

    /**
     * This function sets the alias for the table
     */

    protected function setAlias() : void
    {
        $table = $this->getTable();
        $this->alias = new Alias($table);
    }   
}