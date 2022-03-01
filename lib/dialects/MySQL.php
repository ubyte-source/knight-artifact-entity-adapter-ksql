<?PHP

namespace KSQL\dialects;

use Knight\Configuration;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\dialects\constraint\Dialect;
use KSQL\operations\Select;
use KSQL\operations\select\Limit;
use KSQL\connection\Common as Connection;
use KSQL\connection\drivers\PDO as PDODriver;

/* This class is used to create a MySQL connection */

final class MySQL extends Dialect
{
    use Configuration;

    const PDO = 'mysql:dbname=%s;host=%s;port=%s';

    const CONFIGURATION_DATABASE = 0x3d090;
    const CONFIGURATION_DATABASE_USERNAME = 0x33450;
    const CONFIGURATION_DATABASE_PASSWORD = 0x33451;
    const CONFIGURATION_HOST = 0x30d40;
    const CONFIGURATION_PORT = 0x30d41;

    /**
     * This function returns a PDO connection object
     * 
     * @param string constant The name of the constant to use.
     * 
     * @return A PDO connection driver object.
     */

    public static function Connection(string $constant = 'DEFAULT') : Connection
    {
        $dialect = static::name();

        $connetion_string_host = static::getConfiguration(static::CONFIGURATION_HOST, true, $dialect, $constant);
        $connetion_string_port = static::getConfiguration(static::CONFIGURATION_PORT, true, $dialect, $constant);
        $connetion_string_base = static::getConfiguration(static::CONFIGURATION_DATABASE, true, $dialect, $constant);
        $connetion_string = sprintf(static::PDO, $connetion_string_base, $connetion_string_host, $connetion_string_port);

        $connection_username = static::getConfiguration(static::CONFIGURATION_DATABASE_USERNAME, true, $dialect, $constant);
        $connection_password = static::getConfiguration(static::CONFIGURATION_DATABASE_PASSWORD, true, $dialect, $constant);

        $connection_dialect = static::instance();
        $connection = new PDODriver($connection_dialect, $connetion_string, $connection_username, $connection_password);

        return $connection;
    }

    /**
     * Returns the character 58
     * 
     * @return The character 58.
     */

    public static function BindCharacter() : string
    {
        return chr(58);
    }

    /**
     * This function returns the JSON_OBJECT or JSON_ARRAYAGG function with the column names as the
     * arguments
     * 
     * @param Select select The Select object that we're converting to JSON.
     * 
     * @return The JSON_OBJECT function is being used to create a JSON object from the column names.
     */

    public static function ToJSON(Select $select) : string
    {
        $column = $select->getTable();
        $column = $select->getAllColumns($column, true);
        $column = array_keys($column);

        $column_injection = $select->getInjection()->getColumns();
        $column_injection = array_keys($column_injection);
        $column = array_merge($column, $column_injection);
        $column = array_unique($column, SORT_STRING);
        $column = preg_filter('/^.*$/', chr(34) . '$0' . chr(34) . chr(44) . chr(32) . chr(96) . '$0' . chr(96), $column);
        $column = implode(chr(44) . chr(32), $column);
        $column = 'JSON_OBJECT' . chr(40) . $column . chr(41);

        if (1 !== $select->getLimit()->get())
            $column = 'JSON_ARRAYAGG' . chr(40) . $column . chr(41);

        return $column;
    }

    /**
     * This function returns the last inserted ID of a table
     * 
     * @param Table table The table object that we're inserting into.
     * 
     * @return The last insert id of the table.
     */

    public static function LastInsertID(Table $table) : string
    {
        $child_insert = chr(88) . $table->getHash();
        $child_insert = chr(64) . $child_insert . chr(32) . ':= COALESCE' . chr(40) . chr(64) . $child_insert . chr(44) . chr(32) . 'LAST_INSERT_ID()' . chr(41);
        return $child_insert;
    }

    /**
     * Returns the value of the specified element
     * 
     * @param string elaborate the name of the field to be used in the query.
     * 
     * @return The string 'ANY_VALUE(elaborate)'
     */

    public static function AnyValue(string $elaborate) : string
    {
        $any = 'ANY_VALUE' . chr(40) . $elaborate . chr(41);
        return $any;
    }

    /**
     * This function takes a string and returns a string that is a base64 encoded version of the input
     * string
     * 
     * @param string filtered The string you want to replace.
     * 
     * @return The REPLACE function is being returned.
     */

    public static function FileReplacer(string $filtered) :? string
    {
        $repalce_sintax_base = 'TO_BASE64' . chr(40) . $filtered . chr(41);
        $replace_sintax = 'REPLACE' . chr(40) . $repalce_sintax_base . chr(44) . chr(32) . chr(34) . chr(10) . chr(34) . chr(44) . chr(32) . chr(34) . chr(34) . chr(41);
        return $replace_sintax;
    }

    /**
     * This function is used to limit the number of rows returned by a query
     * 
     * @param Statement statement The statement object to append to.
     * @param Limit limit The limit value.
     * 
     * @return Nothing.
     */

    public static function Limit(Statement $statement, Limit $limit) : void
    {
        $value = $limit->get();
        if (null === $value) return;

        $statement->append('LIMIT');

        $offest = $limit->getOffset();
        if (null !== $offest)
            $statement->append($offest . chr(44));

        $statement->append($value);
    }

    /**
     * This function returns a string that is a natural join of the table name
     * 
     * @param string table The table to join with the current table.
     * 
     * @return A string.
     */

    public static function NaturalJoin(string $table) : string
    {
        $join = 'NATURAL' . chr(32) . 'JOIN' . chr(32) . chr(96) . $table . chr(96);
        return $join;
    }
}