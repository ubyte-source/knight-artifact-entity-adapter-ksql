<?PHP

namespace KSQL\operations\common\features\parser;

use Knight\armor\CustomException;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\adapters\map\common\Bind;

class Query extends Bind
{
    protected $statement;   // Statement
    protected $table;       // Table

    /**
     * Clone the object and all its properties
     * 
     * @return The cloned object.
     */

    public function __clone()
    {
        $variables = get_object_vars($this);
        $variables = array_keys($variables);
        $variables_remove = [];
        array_push($variables_remove, 'statement');
        $variables = array_diff($variables, $variables_remove);
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
     * The constructor for the class
     * 
     * @param Table table The table object that this class is associated with.
     */

    final public function __construct(Table $table)
    {
        $this->setTable($table);
    }

    /**
     * Returns the table object associated with this class
     * 
     * @return The table object.
     */

    public function getTable() : Table
    {
        return $this->table;
    }

    /**
     * The setStatement function sets the statement property to the given statement
     * 
     * @param Statement statement The statement to be executed.
     * 
     * @return The object itself.
     */

    public function setStatement(Statement $statement) : self
    {
        $this->statement = $statement;
        return $this;
    }

   /**
    * Returns the statement object associated with this object
    * 
    * @return The statement object.
    */

    public function getStatement() :? Statement
    {
        return $this->statement;
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
