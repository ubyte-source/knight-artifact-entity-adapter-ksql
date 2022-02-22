<?PHP

namespace KSQL\connection;

use Knight\armor\CustomException;

use KSQL\Statement;
use KSQL\dialects\constraint\Dialect;

interface Bond
{
    public function __construct(Dialect $dialect, string ...$array);
    public function execute(Statement $statement);
    public function getDialect() :? Dialect;
    public function getInstance();
}

abstract class Common implements Bond
{
    protected $instance; // (Instance) Database Connection instance
    protected $dialect;  // (Dialect)
    protected $hash;     // (string)

    public static function dialect(string $dialect) : Dialect
    {
        if (class_exists($dialect, true)) return $dialect::instance();
        throw new CustomException('developer/database/dialect/not/exists');
    }

    
    public function __construct(Dialect $dialect, string ...$array)
    {
        $this->setDialect($dialect);
        $this->setHash(...$array);
    }

    public function getDialect() :? Dialect
    {
        return $this->dialect;
    }

    public function getHash() : string
    {
        return $this->hash;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    protected function setDialect(Dialect $dialect) : void
    {
        $this->dialect = $dialect;
    }

    protected function setHash(string $hash) : void
    {
        $this->hash = $hash;
    }

    protected function setInstance($instance) : void
    {
        $this->instance = $instance;
    }
}