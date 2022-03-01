<?PHP

namespace KSQL\adapters\map;

use KSQL\Initiator;
use KSQL\entity\Table;

/* This class is used to join tables together */

final class JoinedTables
{
    protected $tables = []; // (array) Table

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
     * *This function pushes a table onto the tables array.*
     * 
     * @return The number of tables pushed.
     */

    public function pushTables(Table ...$tables) : int
    {
        foreach ($tables as $table)
            if (false === $table->hasAdapter())
                $table->useAdapter(Initiator::ADAPTER_NAME, Initiator::getNamespaceName());
        return array_push($this->tables, ...$tables);
    }

    /**
     * Given a list of table names, return a list of tables that match those names
     * 
     * @return An array of Table objects.
     */

    public function getTablesByName(string ...$names) : array
    {
        $tables = $this->getTables();
        $tables = array_filter($tables, function (Table $table) use ($names) {
            return in_array($table->getReflection()->getShortName(), $names);
        });
        return $tables;
    }

    /**
     * Returns an array of all the tables in the database
     * 
     * @return An array of table names.
     */

    public function getTables() : array
    {
        return $this->tables;
    }
}