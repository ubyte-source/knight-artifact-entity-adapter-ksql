<?PHP

namespace KSQL\operations\common\features\parser;

use Closure;

use Entity\validations\Matrioska as Defined;

use KSQL\entity\Table;
use KSQL\dialects\constraint\Dialect;
use KSQL\operations\Select;

trait Matrioska
{
    protected static $closure; // Closure

    public static function setClosure(Closure $callable) : void
    {
        static::$closure = $callable;
    }

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

    protected static function getClosure() :? Closure
    {
        return static::$closure;
    }

    protected static function acquiesce(Table $child) : bool
    {
        $injection = $child->hasAdapter() ? $child->getInjection()->getColumns() : array();
        return !$child->isDefault()
            || !empty($injection);
    }
}