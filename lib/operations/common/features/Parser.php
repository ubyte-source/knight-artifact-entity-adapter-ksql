<?PHP

namespace KSQL\operations\common\features;

use KSQL\entity\Table;
use KSQL\dialects\constraint\Dialect;
use KSQL\operations\common\features\parser\Query;
use KSQL\operations\common\features\parser\Matrioska;

/* It's a trait that is used to parse the tables in the query. */

trait Parser
{
    use Matrioska;

    /**
     * It takes a Dialect, a Table, an origin, and an array of hashes. It then recursively calls itself
     * on all of the Table's joined tables, and adds the resulting Query objects to an array
     * 
     * @param Dialect dialect The dialect to use.
     * @param Table data The table that we're going to be joining.
     * @param string origin The table that is being joined to.
     * 
     * @return An array of Query objects.
     */

    public static function tables(Dialect $dialect, Table $data, string $origin, string ...$skip) : array
    {
        $response = [];

        static::matrioska($dialect, $data, $origin);
        $join = $data->getJoinedTables()->getTables();
        $hash = $data->getHash();

        if (true !== in_array($hash, $skip)) array_unshift($join, $data);
        if (null === $join
            || empty($join)) return $response;

        foreach ($join as $i => $table) {
            $table_hash = $table->getHash();
            if (false === in_array($table_hash, $skip)) array_push($response, new Query($table));
            array_push($skip, $table_hash);

            if ($hash !== $table_hash) {
                static::matrioska($dialect, $table, $origin, $data);
                $recursive = static::tables($dialect, $table, $origin, ...$skip);
                array_push($response, ...$recursive);
            }
        }

        return $response;
    }

    /**
     * This function returns the columns that are unique in the table
     * 
     * @param Table table The table object.
     * 
     * @return An array of the columns that are unique.
     */

    public static function uniqueness(Table $table) :? array
    {
        $table_injection = $table->getInjection();
        $table_injection_columns = $table_injection->getColumns();
        $table_injection_columns = array_keys($table_injection_columns);

        $table_keys = $table->getAllFieldsKeys(true);
        $table_keys = array_merge($table_keys, $table_injection_columns);

        $table_uniqueness = $table->getAllFieldsUniqueGroups();
        foreach ($table_uniqueness as $group) {
            $uniqueness_intersection = array_intersect($group, $table_keys);
            if (count($group) === count($uniqueness_intersection)) return $group;
        }

        return null;
    }

    /**
     * It takes a table and a child table, and returns the fields that are unique to the child table
     * 
     * @param Table table The table that we're trying to match against.
     * @param Table child The child table.
     * @param bool filtered If true, only fields that are not null will be used.
     * 
     * @return An array of fields that are unique to the table.
     */

    public static function getUniquenessMatch(Table $table, Table $child, bool $filtered = true) :? array
    {
        $child_fields = $child->getAllFieldsKeys();
        $table_values = $table->getAllFieldsValues($filtered, false);
        $table_uniqueness = $table->getAllFieldsUniqueGroups();
        foreach ($table_uniqueness as $main) {
            $main_match = array_intersect_key($table_values, array_fill_keys($main, null));
            $main_match = array_filter($main_match, function (string $name) use ($child_fields) {
                return in_array($name, $child_fields);
            }, ARRAY_FILTER_USE_KEY);
            if (count($main) === count($main_match)) return $main_match;
        }
        return null;
    }
}
