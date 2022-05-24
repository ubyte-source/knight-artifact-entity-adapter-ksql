<?PHP

namespace KSQL\operations\select;

use KSQL\entity\Table;

/* The Alias class is used to create an alias for a field or table */

class Alias
{
    protected $table; // Table
    protected $name;  // (string)

    protected static $increment = 0;

    /**
     * The constructor for the class
     * 
     * @param Table table The table to be used by the model.
     */

    public function __construct(Table $table)
    {
        $this->setTable($table);
        $this->auto();
    }

    /**
     * Set the name of the alias to the given name.
     * 
     * @param string name The name of the parameter.
     * 
     * @return The object itself.
     */

    public function setName(string $name) : string
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the person.
     *
     * @return The name of the alias.
     */

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * The setTable function is used to set the table property of the class
     * 
     * @param Table table The table to be used for the query.
     */

    protected function setTable(Table $table) : void
    {
        $this->table = $table;
    }

    /**
     * The auto() function is a method that is called when a new instance of the class is created. 
     * used to set the name of the instance to a lowercase letter followed by the id of the instance
     */

    protected function auto() : void
    {
        $id = static::$increment++;
        $this->name = chr(97) . (string)$id;
    }
}
