<?PHP

namespace KSQL;

use KSQL\connection\Common as Connection;

/* This class is used to create connections to databases */

final class Factory
{
    protected static $databases = []; // (array) Connection

    protected function __construct() {}

    /**
     * Creates a new connection to a database
     * 
     * @param string dialect The dialect to use.
     * @param string constant The constant that will be used to identify the connection.
     * 
     * @return A connection object.
     */

    public static function connect(string $dialect = 'KSQL\\dialects\\MySQL', string $constant = 'DEFAULT') : Connection
    {
        $connection_dialect = Connection::dialect($dialect);
        $connection = $connection_dialect::Connection($constant);

        array_push(static::$databases, $connection);

        return $connection;
    }

    /**
     * This function disconnects a database from the pool
     * 
     * @param string hash The hash of the database to disconnect.
     * 
     * @return This class itself.
     */

    public static function disconnect(string $hash) : self
    {
        foreach (static::$databases as $key => $database)
            if ($hash === $database->getHash())
                unset(static::$databases[$key]);

        static::$databases = array_values(static::$databases);

        return $this;
    }

    /**
     * This function takes an array of strings and returns a hash of the array
     * 
     * @return A string.
     */

    public static function dialHash(string ...$arguments) : string
    {
        $hash = serialize($arguments);
        $hash = md5($hash);
        return $hash;
    }

    /**
     * Given a hash, return the connection object that has that hash.
     * 
     * The function is a bit long, but it's not too bad. The first thing we do is loop through all of
     * the connections in the static::array. If the hash is equal to the hash of the current
     * connection, we return the connection. If we don't find a match, we return null
     * 
     * @param string hash The hash of the connection.
     * 
     * @return A Connection object or null.
     */

    public static function searchConnectionFromHash(string $hash) :? Connection
    {
        foreach (static::$databases as $database)
            if ($hash === $database->getHash())
                return $database;
        return null;
    }
}
