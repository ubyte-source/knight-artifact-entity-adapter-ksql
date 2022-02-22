<?PHP

namespace KSQL\operations\common;

use PDOStatement;

use Knight\armor\CustomException;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\operations\common\Base;
use KSQL\operations\common\features\Where;

interface Query
{
    public function getQueries() : array;
}

abstract class Handling extends Base implements Query
{
    use Where;

    protected $skip = []; // (array) Table

    public function run()
    {
        $queries = $this->getQueries();
        $execute = null;
        foreach ($queries as $query) {
            $query_statement = $query->getStatement();
            if (null === $query_statement) throw new CustomException('developer/database/handling/statement');
            $execute = $query_statement->execute();
            if (null === $execute) break;
        }

        return $execute;
    }

    public function setSkip(Table ...$skip) : self
    {
        $this->skip = $skip;
        return $this;
    }

    protected function getSkip() : array
    {
        return $this->skip;
    }
}