<?PHP

namespace KSQL\operations;

use KSQL\Statement;
use KSQL\entity\Table;
use KSQL\operations\common\Handling;

/* It takes a list of tables, and returns a list of queries */

class Delete extends Handling
{
   /**
    * It takes a list of tables, and returns a list of queries
    * 
    * @return An array of queries.
    */

    public function getQueries() : array
    {
        $core = $this->getCore();
        $core_connection = $core->getConnection();
        $core_connection_dialect = $core_connection->getDialect();

        $skip = $this->getSkip();
        $skip = array_map(function (Table $table) {
            return $table->getHash();
        }, $skip);

        $tables = $core->getTable();
        $tables = static::tables($core_connection_dialect, $tables, static::class, ...$skip);
        foreach ($tables as $query) {
            $table = $query->getTable();

            $statement = new Statement($core_connection);
            $statement->append('DELETE');
            $statement->append('FROM');
            $statement_table = $table->getCollectionName();
            $statement->append(chr(96) . $statement_table . chr(96));

            if ($statement_where = $this->where($core_connection_dialect, $table)) {
                $statement_where_sintax = $statement_where->get();
                if (0 !== strlen($statement_where_sintax)) {
                    $statement->append('WHERE');
                    $statement->append($statement_where->get());
                    $statement->pushFromBind($statement_where);
                }
            }

            $query->setStatement($statement);
        }

        return $tables;
    }
}
