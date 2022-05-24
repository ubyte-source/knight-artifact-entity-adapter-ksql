<?PHP

namespace KSQL\connection\drivers;

use PDO as Original;
use PDOStatement;
use PDOException;

use Knight\armor\Output;

use Entity\Map;

use KSQL\Factory;
use KSQL\Statement;
use KSQL\dialects\constraint\Dialect;
use KSQL\connection\Common;

/* This class is responsible for preparing the statement and binding the parameters */

final class PDO extends Common
{
    protected $prepare = []; // (array) PDOStatement

    /**
     * If the value is an array or an object, convert it to a JSON string
     * 
     * @param value The value to be converted.
     * 
     * @return The value of the field.
     */

    public static function converter(&$value) : void
    {
        if (is_array($value) || is_object($value)) {
            $reference = array(&$value);
            array_walk_recursive($reference, function (&$item) {
                if (false === ($item instanceof Map)) return;
                $item = $item->getAllFieldsValues(true, false);
            });
            $value = Output::json($value);
            return;
        }

        if (is_bool($value))
            $value = (int)(bool)$value;
    }

    /**
     * The constructor of this class will create a PDO object with the given parameters
     * 
     * @param Dialect dialect The dialect to use.
     */

    public function __construct(Dialect $dialect, string ...$array)
    {
        parent::__construct($dialect, ...$array);

        $pdo_hash = $this->getHash();
        $pdo = Factory::searchConnectionFromHash($pdo_hash);
        $pdo = null !== $pdo && $pdo instanceof Common ? $pdo->getInstance() : new Original($array[0], $array[1], $array[2], [
            Original::ATTR_TIMEOUT => 4,
            Original::ATTR_ERRMODE => Original::ERRMODE_EXCEPTION
        ]);

        $this->setInstance($pdo);
    }

    /**
     * This function is responsible for preparing the statement and binding the parameters
     * 
     * @param Statement statement The statement object that is being executed.
     * 
     * @return The PDOStatement object.
     */

    public function execute(Statement $statement)
    {
        try {
            $instance = $this->getInstance();
            if (null === $instance)
                throw new CustomException('developer/database/statement/connection/instance');

            $sintax = $statement->get();
            $sintax_prepare = $this->getPrepare($sintax);
            if (null === $sintax_prepare)
                throw new CustomException('developer/database/statement/connection/prepare');

            $sintax_bind = $statement->getBind();
            $sintax_bind_dialect = $this->getDialect();
            $sintax_bind_dialect_separator = $sintax_bind_dialect::BindCharacter();
            $sintax_bind = array_filter($sintax_bind, function (string $key) use ($sintax_bind_dialect_separator, $sintax) {
                $regex = '/' . chr(40) . $sintax_bind_dialect_separator . $key . chr(41) . chr(92) . chr(98) . '/';
                return preg_match($regex, $sintax);
            }, ARRAY_FILTER_USE_KEY);

            array_walk($sintax_bind, function ($value, $key) use ($sintax_prepare) {

                static::converter($value);

                if (false === is_resource($value)) return $sintax_prepare->bindParam($key, $value, Original::PARAM_STR);
                if (get_resource_type($value) !== 'stream')
                    throw new CustomException('developer/database/statement/connection/resource');

                return $sintax_prepare->bindParam($key, $value, Original::PARAM_LOB);
            });

            if (!!$sintax_prepare->execute()) return $sintax_prepare;
        } catch (PDOException $exception) {
        }

        return null;
    }

    /**
     * If the statement has already been prepared, return the prepared statement. Otherwise, prepare
     * the statement and return the prepared statement
     * 
     * @param string statement The SQL statement to prepare.
     * 
     * @return A PDOStatement object.
     */

    protected function getPrepare(string $statement) :? PDOStatement
    {
        $hash = md5($statement);
        if (array_key_exists($hash, $this->prepare)) return $this->prepare[$hash];

        $prepare = $this->getInstance()->prepare($statement);
        if (false === $prepare) return null;

        $this->prepare[$hash] = $prepare;

        return $prepare;
    }
}
