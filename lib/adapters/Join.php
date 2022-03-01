<?PHP

namespace KSQL\adapters;

use Entity\Adapter;

use KSQL\entity\Table;
use KSQL\adapters\map\Injection;
use KSQL\adapters\map\JoinedTables;

/* The Join class is used to join tables together */

class Join extends Adapter
{
    protected $injection; // Injection
    protected $tables;    // JoinedTables

    /**
     * The constructor sets the injection and joined tables properties to null, and then instantiates a
     * new Injection and JoinedTables object
     */

    public function __construct()
    {
        $this->setInjection(null, new Injection());
        $this->setJoinedTables(null, new JoinedTables());
    }

   /**
    * Clone the object and all its properties
    * 
    * @return The object itself.
    */

    public function __clone()
    {
        $variables = get_object_vars($this);
        $variables = array_keys($variables);
        $variables_glue = [];
        foreach ($variables as $name) array_push($variables_glue, array(&$this->$name));
        array_walk_recursive($variables_glue, function (&$item, $name) {
            if (false === is_object($item)) return;
            $clone = clone $item;
            if ($clone instanceof Table) $clone->cloneHashEntity($item);
            $item = $clone;
        });
    }

    /**
     * The setInjection function sets the injection property of the class to the injection parameter
     * 
     * @param table The table to inject into.
     * @param Injection injection The injection to use.
     * 
     * @return The current object.
     */

    public function setInjection(?Table $table, Injection $injection) : self
    {
        $this->injection = $injection;
        return $this;
    }

    /**
     * The setJoinedTables function sets the tables property to the tables parameter
     * 
     * @param table The table that is being joined.
     * @param JoinedTables tables The tables that are joined.
     * 
     * @return A new instance of the class.
     */

    public function setJoinedTables(?Table $table, JoinedTables $tables) : self
    {
        $this->tables = $tables;
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
     * Returns the joined tables
     * 
     * @return An instance of the JoinedTables class.
     */

    public function getJoinedTables() : JoinedTables
    {
        return $this->tables;
    }

    /**
     * This function joins the table with the table passed in as an argument
     * 
     * @param table The table to join with.
     * 
     * @return The last table in the chain of joins.
     */

    public function join(?Table $table, Table ...$tables) : Table
    {
        $tables_last = array_pop($tables);
        if (null === $tables_last) return $this->getReference();

        $this->getJoinedTables()->pushTables($tables_last);
        if (empty($tables)) return $tables_last;

        $injection = $tables_last->getInjection();
        $container = $tables_last->getJoinedTables();
        foreach ($tables as $item) {
            $this->getJoinedTables()->pushTables($item);
            $item->setInjection($injection);
            $item->setJoinedTables($container);
        }

        return $tables_last;
    }

    /**
     * Given a table and a field name, return the field path
     * 
     * @param table The Table object that contains the field.
     * @param string name The name of the field.
     * 
     * @return The field path for the field in the table.
     */

    public function getFieldPath(?Table $table, string $name) : string
    {
        $table_name = $table->getCollectionName();
        $table_name = chr(96) . $table_name . chr(96);
        $table_field = $table->getField($name);
        $table_field_name = $table_field->getName();
        $table_field_name = chr(96) . $table_field_name . chr(96);
        $table_field_name = $table_name . chr(46) . $table_field_name;
        return $table_field_name;
    }
}