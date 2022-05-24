<?PHP

namespace KSQL\connection;

use Knight\armor\CustomException;

use KSQL\Statement;
use KSQL\dialects\constraint\Dialect;

/* This is the interface that all the classes that extend the Common class must implement. */

interface Bond
{
    public function __construct(Dialect $dialect, string ...$array);
    public function execute(Statement $statement);
    public function getDialect() :? Dialect;
    public function getInstance();
}

/* The Common class is an abstract class that is used to create a common interface for all the classes
that extend it */

abstract class Common implements Bond
{
    protected $instance; // (Instance) Database Connection instance
    protected $dialect;  // (Dialect)
    protected $hash;     // (string)

    /**
     * If the class exists, return an instance of it. Otherwise, throw an exception
     * 
     * @param string dialect The name of the dialect class.
     * 
     * @return An instance of the class that was passed in.
     */

    public static function dialect(string $dialect) : Dialect
    {
        if (class_exists($dialect, true)) return $dialect::instance();
        throw new CustomException('developer/database/dialect/not/exists');
    }

    /**
     * The constructor takes a dialect and an array of strings
     * 
     * @param Dialect dialect The dialect to use.
     */

    public function __construct(Dialect $dialect, string ...$array)
    {
        $this->setDialect($dialect);
        $this->setHash(...$array);
    }

    /**
     * Returns the dialect of the database
     * 
     * @return The dialect object.
     */

    public function getDialect() :? Dialect
    {
        return $this->dialect;
    }

    /**
     * Returns the hash of the current object
     * 
     * @return The hash of the password.
     */

    public function getHash() : string
    {
        return $this->hash;
    }

    /**
     * Returns the instance of the class
     * 
     * @return The instance of the class.
     */

    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * The setDialect function sets the dialect property to the Dialect object passed in as a parameter
     * 
     * @param Dialect dialect The dialect to use for the query.
     */

    protected function setDialect(Dialect $dialect) : void
    {
        $this->dialect = $dialect;
    }

    /**
     * Set the hash of the password
     * 
     * @param string hash The hash of the file.
     */

    protected function setHash(string $hash) : void
    {
        $this->hash = $hash;
    }

    /**
     * The setInstance function sets the instance variable to the value passed to it
     * 
     * @param instance The instance of the class that is being instantiated.
     */

    protected function setInstance($instance) : void
    {
        $this->instance = $instance;
    }
}
