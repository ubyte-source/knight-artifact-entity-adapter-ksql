<?PHP

namespace KSQL;

use Closure;
use ReflectionClass;

use Knight\armor\CustomException;

use KSQL\entity\Table;
use KSQL\operations\common\Base;
use KSQL\connection\Common as Connection;

/* This class is used to create a new instance of the class and set the connection and table properties */

final class Initiator
{
    const OPERATIONS = 'operations';
    const ADAPTER_NAME = 'Join';

    protected $connection; // Connection
    protected $table;      // Table

    protected function __construct() {}

    /**
     * Returns the namespace name of the class
     * 
     * @return The namespace name of the class.
     */

    public static function getNamespaceName() : string
    {
        $class = new ReflectionClass(static::class);
        return $class->getNamespaceName();
    }

    /**
     * Clone the object and all its properties
     * 
     * @return The object itself.
     */

    public function __clone()
    {
        $variables = get_object_vars($this);
        $variables = array_keys($variables);
        $variables_remove = [];
        array_push($variables_remove, 'connection');
        $variables = array_diff($variables, $variables_remove);
        $variables_glue = [];
        foreach ($variables as $name) array_push($variables_glue, array(&$this->$name));
        array_walk_recursive($variables_glue, function (&$item, $name) {
            if (false === is_object($item)) return;
            $clone = clone $item;
            if ($clone instanceof Table) $clone->cloneHashEntity($item);
            $item = $clone;
        });
    }

    /**
     * If the method called is a valid operation, create an instance of the operation class and return it
     * 
     * @param string method The method name that was called.
     * @param array arguments The arguments passed to the method.
     * 
     * @return An instance of the operation class.
     */

    public function __call(string $method, array $arguments) : Base
    {
        $class_name = strtolower($method);
        $class_name = ucfirst($class_name);

        $instance = __namespace__ . '\\' . static::OPERATIONS . '\\' . $class_name;
        $instance = new $instance($this, $arguments);
        if ($instance instanceof Base) return $instance;

        throw new CustomException('developer/database/call/operation/missmatch');
    }

    /**
     * This function creates a new instance of the class and sets the connection and table properties
     * 
     * @param connection The connection to use. If not specified, the default connection will be used.
     * @param Table table The table object that we're going to be working with.
     * 
     * @return An instance of the class.
     */

    public static function start(?Connection $connection, Table $table) : self
    {
        $instance = new static();
        $instance->setConnection($connection);
        $instance->table = $table;

        if (false === $instance->table->hasAdapter())
            $instance->table->useAdapter(static::ADAPTER_NAME, __namespace__);

        return $instance;
    }

    /**
     * Returns the table object associated with this class
     * 
     * @return The table object.
     */

    public function getTable() : Table
    {
        return $this->table;
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