<?PHP

namespace KSQL\operations\select;

use KSQL\adapters\map\common\Bind;
use KSQL\operations\Select;
use KSQL\operations\select\group\Collection;
use KSQL\dialects\constraint\Dialect;

/* The Group class is used to group the results of a query */

class Group extends Bind
{
    protected $having;           // (string)
    protected $collections = []; // (array) Collection

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
     * It takes a string, replaces all instances of the variable prefix with the bound variable, and
     * returns the string
     * 
     * @param Dialect dialect The dialect to use.
     * @param having The SQL having clause.
     * 
     * @return The query object.
     */

    public function setHaving(Dialect $dialect, ?string $having, string ...$data) : self
    {
        $bound = $this->resetBind()->getBound(...$data);

        $having_injection_variables_expression_separator = $dialect::BindCharacter();
        $having_injection_variables_expression = chr(47) . static::BIND_VARIABLE_PREFIX . chr(40) . '\\' . chr(100) . chr(43) . chr(41) . chr(47);
        $having_injection_variables = preg_replace_callback($having_injection_variables_expression, function ($match) use ($having_injection_variables_expression_separator, $bound) {
            return array_key_exists($match[1], $bound)
                ? $having_injection_variables_expression_separator . $bound[$match[1]]
                : $match[0];
        }, $having);

        $this->having = $having_injection_variables;

        return $this;
    }

    /**
     * Returns the having clause of the query
     * 
     * @return The having clause of the query.
     */

    public function getHaving() :? string
    {
        return $this->having;
    }

    /**
     * The function takes in an array of collections and sets the collections property to that array
     * 
     * @return Nothing.
     */

    public function setCollections(Collection ...$collections) : self
    {
        $this->collections = $collections;
        return $this;
    }

    /**
     * AddCollections() adds a collection to the array of collections
     * 
     * @return Nothing.
     */

    public function addCollections(Collection ...$collections) : self
    {
        array_push($this->collections, ...$collections);
        return $this;
    }

    /**
     * It returns the columns of the collections
     * 
     * @param select The Select object that will be used to get the columns.
     * @param bool name If true, the function will return an array of column names instead of an array
     * of column definitions.
     * 
     * @return The columns of the tables in the database.
     */

    public function getColumns(?Select $select = null, bool $name = false) : array
    {
        $collections = $this->getCollections();
        $collections_condition = array_map(function (Collection $collection) use ($select) {
            return $collection->elaborate($select);
        }, $collections);

        if (empty($collections_condition)) return $collections_condition;
        if (false === $name) $collections_condition = array_map('array_values', $collections_condition);

        $collections_condition = call_user_func_array('array_merge', $collections_condition);
        return false === $name ? $collections_condition : array_keys($collections_condition);
    }

    /**
     * This function returns an array of the collections that are available to the user
     * 
     * @return An array of the collections that are being used in the application.
     */

    protected function getCollections() : array
    {
        return $this->collections;
    }
}
