<?PHP

namespace KSQL\operations\common;

use PDOStatement;

use Knight\armor\CustomException;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\operations\common\Base;
use KSQL\operations\common\features\Where;

/* This is the interface that is used to handle queries. */

interface Query
{
    public function getQueries() : array;
}

/* The Handling class is an abstract class that implements the Query interface. It is used to handle
queries and return the result of the last query */

abstract class Handling extends Base implements Query
{
    use Where;

    protected $skip = []; // (array) Table

    /**
     * The function runs the queries and returns the result of the last query
     * 
     * @return The result of the last query executed.
     */

    public function run() :? bool
    {
        $queries = $this->getQueries();
        foreach ($queries as $query) {
            $query_statement = $query->getStatement();
            if (null === $query_statement) throw new CustomException('developer/database/handling/statement');
            if (null === $query_statement->execute()) return null;
        }

        return true;
    }

    /**
     * The setSkip function sets the skip property of the class to the value of the skip parameter
     * 
     * @return Nothing.
     */

    public function setSkip(Table ...$skip) : self
    {
        $this->skip = $skip;
        return $this;
    }

    /**
     * Returns the skip array
     * 
     * @return An array of the skip values.
     */

    protected function getSkip() : array
    {
        return $this->skip;
    }
}