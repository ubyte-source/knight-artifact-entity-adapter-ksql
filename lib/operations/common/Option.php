<?PHP

namespace KSQL\operations\common;

use ReflectionClass;

use KSQL\entity\Table;

/* This class is used to base method in other field class */

abstract class Option
{
    protected $table; // Table

    /**
     * Get all the constants from a class
     * 
     * @param string instance The instance of the class you want to get the constants of.
     * 
     * @return An array of constants.
     */

    public static function getConstants(string $instance) : array
    {
        $constants = new ReflectionClass($instance);
        $constants = $constants->getConstants();
        return $constants;
    }
    
    /**
     * The constructor for the class
     * 
     * @param Table table The table object that is being used to create the table.
     */

    public function __construct(Table $table)
    {
        $this->setTable($table);
    }

    /**
     * Returns the table object associated with this object
     * 
     * @return The table object.
     */

    public function getTable() : Table
    {
        return $this->table;
    }

    /**
     * The setTable function sets the table property to the Table object passed to it
     * 
     * @param Table table The table to be used for the query.
     */

    protected function setTable(Table $table) : void
    {
        $this->table = $table;
    }
}