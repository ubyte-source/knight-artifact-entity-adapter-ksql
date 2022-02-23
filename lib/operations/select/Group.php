<?PHP

namespace KSQL\operations\select;

use KSQL\adapters\map\common\Bind;
use KSQL\operations\Select;
use KSQL\operations\select\group\Collection;
use KSQL\dialects\constraint\Dialect;

class Group extends Bind
{
    protected $having;           // (string)
    protected $collections = []; // (array) Collection

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

    public function getHaving() :? string
    {
        return $this->having;
    }

    public function setCollections(Collection ...$collections) : self
    {
        $this->collections = $collections;
        return $this;
    }

    public function addCollections(Collection ...$collections) : self
    {
        array_push($this->collections, ...$collections);
        return $this;
    }

    public function getColumns(Dialect $dialect, ?Select $select = null, bool $name = false) : array
    {
        $collections = $this->getCollections();
        $collections_condition = array_map(function (Collection $collection) use ($dialect, $select) {
            return $collection->elaborate($dialect, $select);
        }, $collections);

        if (empty($collections_condition)) return $collections_condition;
        if (false === $name) $collections_condition = array_map('array_values', $collections_condition);

        $collections_condition = call_user_func_array('array_merge', $collections_condition);
        return false === $name ? $collections_condition : array_keys($collections_condition);
    }

    protected function getCollections() : array
    {
        return $this->collections;
    }
}