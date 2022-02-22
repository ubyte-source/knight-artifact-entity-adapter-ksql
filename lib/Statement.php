<?PHP

namespace KSQL;

use Knight\armor\CustomException;

use KSQL\adapters\map\common\Bind;
use KSQL\connection\Common as Connection;

class Statement extends Bind
{
    protected $connection;  // Connection
    protected $sintax = ''; // (string)

    public function __construct(Connection $connection = null)
    {
        $this->setConnection($connection);
    }

    public function __call(string $method, array $arguments)
    {
        $connection = $this->getConnection();
        if (null !== $connection
            && method_exists($connection, $method)) return call_user_func_array([$connection, $method], [$this]);

        throw new CustomException('developer/database/statement/method' . chr(47) . $method);
    }

    public function get() : string
    {
        return trim($this->sintax);
    }

    public function append(string $string, bool $white = true) : self
    {
        $this->sintax .= $string;
        if (true === $white) $this->sintax .= chr(32);
        return $this;
    }

    public function set(string $string) : self
    {
        $this->sintax = $string;
        return $this;
    }

    public function concat(?self $statement) : self
    {
        if (null === $statement) return $this;
        $this->append($statement->get());
        $this->pushFromBind($statement);
        return $this;
    }

    public function getConnection() :? Connection
    {
        return $this->connection;
    }

    protected function setConnection(?Connection $connection) : void
    {
        $this->connection = $connection;
    }
}