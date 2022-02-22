<?PHP

namespace KSQL;

use KSQL\connection\Common as Connection;

final class Factory
{
    protected static $databases = []; // (array) Connection

    protected function __construct() {}

    public static function connect(string $dialect = 'KSQL\\dialects\\MySQL', string $constant = 'DEFAULT') : Connection
    {
        $connection_dialect = Connection::dialect($dialect);
        $connection = $connection_dialect::Connection($constant);

        array_push(static::$databases, $connection);

        return $connection;
    }

    public static function disconnect(string $hash) : self
    {
        foreach (static::$databases as $key => $database)
            if ($hash === $database->getHash())
                unset(static::$databases[$key]);

        static::$databases = array_values(static::$databases);

        return $this;
    }

    public static function dialHash(string ...$arguments) : string
    {
        $hash = serialize($arguments);
        $hash = md5($hash);
        return $hash;
    }

    public static function searchConnectionFromHash(string $hash) :? Connection
    {
        foreach (static::$databases as $database)
            if ($hash === $database->getHash())
                return $database;
        return null;
    }
}