<?PHP

namespace KSQL;

use Knight\armor\CustomException;

use KSQL\adapters\map\common\Bind;
use KSQL\connection\Common as Connection;

/* The Statement class is a class that is used to build a query */

class Statement extends Bind
{
    protected $connection;  // Connection
    protected $sintax = ''; // (string)

    /**
     * The constructor function takes a Connection object as a parameter. If no Connection object is
     * passed, it creates a new Connection object
     * 
     * @param Connection connection The connection to use for this query. If null, the default
     * connection will be used.
     */

    public function __construct(Connection $connection = null)
    {
        $this->setConnection($connection);
    }

    /**
     * If the method exists on the connection, call it
     * 
     * @param string method The name of the method that was called.
     * @param array arguments The arguments passed to the method.
     * 
     * @return The connection object.
     */

    public function __call(string $method, array $arguments)
    {
        $connection = $this->getConnection();
        if (null !== $connection
            && method_exists($connection, $method)) return call_user_func_array([$connection, $method], [$this]);

        throw new CustomException('developer/database/statement/method' . chr(47) . $method);
    }

    /**
     * Returns the value of the sintax property
     * 
     * @return The string that is being returned is the string that was passed into the constructor.
     */

    public function get() : string
    {
        return trim($this->sintax);
    }

    /**
     * It appends a string to the sintax property of the class.
     * 
     * @param string value The string to be appended to the sintax.
     * @param bool white if true, a space will be added to the end of the string.
     * @param the parameters binded into value.
     * 
     * @return self The object itself.
     */

    public function append(string $value, bool $white = true, ...$data) : self
    {
        if (false === empty($data)) {
            $value_dialect = $this->getConnection()->getDialect();
            $value = $this->getBindedString($value_dialect, $value, ...$data);
        }

        $this->sintax .= $value;
        if (true === $white) $this->sintax .= chr(32);

        return $this;
    }

    /**
     * The set function sets the sintax property to the string passed to it
     * 
     * @param string string The string to be parsed.
     * 
     * @return Nothing.
     */

    public function set(string $string) : self
    {
        $this->sintax = $string;
        return $this;
    }

    /**
     * If the statement is null, return this. Otherwise, append the statement's query to this query and
     * push the statement's bind parameters to this query's bind parameters
     * 
     * @param statement The statement to append to the current statement.
     * 
     * @return The same instance of the class.
     */

    public function concat(?self $statement) : self
    {
        if (null === $statement) return $this;
        $this->append($statement->get());
        $this->pushFromBind($statement);
        return $this;
    }

    /**
     * Returns the connection object
     * 
     * @return A connection object.
     */

    public function getConnection() :? Connection
    {
        return $this->connection;
    }

    /**
     * The setConnection function sets the connection property to the value of the connection parameter
     * 
     * @param connection The connection to the database.
     */

    protected function setConnection(?Connection $connection) : void
    {
        $this->connection = $connection;
    }
}
