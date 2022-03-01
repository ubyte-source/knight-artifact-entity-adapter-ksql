<?PHP

namespace KSQL\operations\common\features\parser;

use Closure;

use Entity\validations\Matrioska as Defined;

use KSQL\entity\Table;
use KSQL\dialects\constraint\Dialect;
use KSQL\operations\Select;

/* The trait is used to add a method to the class. */

trait Matrioska
{
    protected static $closure; // Closure

    /**
     * Set the closure to be called when the event is triggered
     * 
     * @param Closure callable The callable to be called when the event is triggered.
     */

    public static function setClosure(Closure $callable) : void
    {
        static::$closure = $callable;
    }

    /**
     * If the field is a reference to a table, then the table is joined to the child table
     * 
     * @param Dialect dialect The dialect of the database.
     * @param Table child The table that is being joined to the parent table.
     * @param string type The type of the field.
     * @param Table table The table that is being joined to.
     * 
     * @return Nothing.
     */

    protected static function matrioska(Dialect $dialect, Table $child, string $type, Table $table = null) : void
    {
        if (!static::acquiesce($child)
            || Select::class === $type) return;

        if (null !== $table) {
            $table_uniqueness = static::getUniquenessMatch($table, $child);
            $table_operations = static::getUniquenessMatch($table, $child, false);
            if (null !== $table_uniqueness) $child->setSafeMode(false)->setFromAssociative($table_uniqueness)->setSafeMode(true);
            if (null === $table_uniqueness
                && empty($table_operations)) return;

            if (null !== $table_uniqueness) $table_operations = array_diff_key($table_operations, $table_uniqueness);
            if (false === empty($table_operations)) {
                if (1 !== count($table_operations)) throw new CustomException('developer/database/ksql/operations/common/features/parser/fields/multiple/not/acquiesceed');
                $table_operations = array_keys($table_operations);
                $table_operations = reset($table_operations);

                $child_insert = $dialect::LastInsertID($table);
                $child->getInjection()->addColumn($dialect, $table_operations, $child_insert);
                $child->getField($table_operations)->setProtected(true);
            }
        }

        $callable = static::getClosure();
        if (null !== $callable) call_user_func($callable, $child);

        $child_fields = $child->getFields();
        foreach ($child_fields as $field) {
            $field_type = $field->getType(false);
            if (Defined::class !== $field_type) continue;

            $union = $total = 0;
            $reference = $field->getValue();
            $reference = array($reference);
            array_walk_recursive($reference, function (&$item) use ($dialect, $child, $type, &$union, &$total) {
                $total++;
                $name = $item->getCollectionName();
                if (null === $name) return;

                $union++;

                if (static::acquiesce($item)) {
                    $child->join($item);
                    return static::matrioska($dialect, $item, $type, $child);
                }
            });

            if ($union === $total) $child->removeField($field->getName());
        }
    }

    /**
     * Get the closure that is used to generate the class.
     * 
     * @return A closure.
     */

    protected static function getClosure() :? Closure
    {
        return static::$closure;
    }

    /**
     * If the child table has an adapter,
     * then the adapter's columns are used to determine if the child table is default.
     * If the child table has no adapter, then the child table is default if it has no columns
     * 
     * @param Table child The child table.
     * 
     * @return A boolean value.
     */

    protected static function acquiesce(Table $child) : bool
    {
        $injection = $child->hasAdapter() ? $child->getInjection()->getColumns() : array();
        return !$child->isDefault()
            || !empty($injection);
    }
}