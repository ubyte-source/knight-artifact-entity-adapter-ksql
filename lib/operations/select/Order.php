<?PHP

namespace KSQL\operations\select;

use KSQL\operations\Select;
use KSQL\operations\select\order\Direction;
use KSQL\operations\select\order\Field;
use KSQL\operations\select\order\base\Column;

/* This class is used to generate the SQL for the ORDER BY clause */

class Order
{
    protected $collections = []; // (array) Column extended

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
        });
    }

    /**
     * The function takes an array of Direction objects and pushes them into the collections array
     * 
     * @return Nothing.
     */

    public function pushDirections(Direction ...$directions) : self
    {
        if (!!$directions) array_push($this->collections, ...$directions);
        return $this;
    }

    /**
     * This function adds a field to the collection of fields
     * 
     * @return Nothing.
     */

    public function pushFields(Field ...$fields) : self
    {
        if (!!$fields) array_push($this->collections, ...$fields);
        return $this;
    }

    /**
     * This function returns an array of Column objects that are associated with this table
     * 
     * @param select The Select object that is being used to generate the SQL.
     * 
     * @return An array of strings.
     */

    public function getColumns(?Select $select) : array
    {
        $collections = $this->getCollections();
        $collections_condition = array_map(function (Column $column) use ($select) {
            return $column->elaborate($select);
        }, $collections);
        return $collections_condition;
    }

    /**
     * This function returns an array of all the collections in this order statement
     * 
     * @return An array of collection objects.
     */

    public function getCollections() : array
    {
        return $this->collections;
    }
}