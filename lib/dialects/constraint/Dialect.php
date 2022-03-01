<?PHP

namespace KSQL\dialects\constraint;

use ReflectionClass;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\operations\Select;
use KSQL\operations\select\Limit;
use KSQL\connection\Common as Connection;

/* A contract. */

interface Bond
{
    public static function Connection(string $constant = 'DEFAULT') : Connection;
    public static function BindCharacter() : string;
    public static function ToJSON(Select $select) : string;
    public static function LastInsertID(Table $table) : string;
    public static function AnyValue(string $elaborate) : string;
    public static function FileReplacer(string $filtered) :? string;
    public static function Limit(Statement $statement, Limit $limit) : void;
    public static function NaturalJoin(string $table) : string;
}

/* The Dialect class is a singleton class that implements the Bond interface */

abstract class Dialect implements Bond
{
    const UNKNOWN = 'unknown';

    protected function __construct() {}

    /* This is a singleton pattern. */

    final public static function instance() : self
    {
        static $instance;
        if (null === $instance) $instance = new static();
        return $instance;
    }

    /* Return a neme of class. */

    final public static function name() : string
    {
        $dialect = new ReflectionClass(static::class);
        $dialect = $dialect->getShortName();
        return $dialect;
    }
}