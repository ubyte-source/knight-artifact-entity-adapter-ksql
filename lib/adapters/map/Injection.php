<?PHP

namespace KSQL\adapters\map;

use ReflectionClass;

use Knight\armor\CustomException;

use KSQL\Statement;
use KSQL\operations\Select;
use KSQL\dialects\constraint\Dialect;
use KSQL\adapters\map\common\Bind;

/* This class is used to inject values into the query */

final class Injection extends Bind
{
    const BIND_NAME = '\\#name\\#';

    const FIELD = 0x258;
    const WHERE = 0x2bc;
    const CLEAN = 0x320;

    protected $columns = []; // (array)

    /**
     * Returns an array of the columns in the table
     * 
     * @return An array of column names.
     */

    public function getColumns() : array
    {
        return $this->columns;
    }

    /**
     * Resets the bind parameters and columns
     * 
     * @return self The object itself.
     */

    public function reset() : self
    {
        $this->resetBind();
        $this->columns = array();
        return $this;
    }

    /**
     * Get all the constants from a class
     * 
     * @param string instance The instance of the class you want to get the constants of.
     * 
     * @return An array of constants.
     */

    public static function getConstants(string $instance) : array
    {
        $constants = new ReflectionClass($instance);
        $constants = $constants->getConstants();
        return $constants;
    }

    /**
     * It takes a field name and a value, and adds them to the columns array
     * 
     * @param Dialect dialect The dialect to use.
     * @param string field_name The name of the field to be added to the query.
     * @param string value The value to be inserted into the column.
     * 
     * @return The current instance of the class.
     */

    public function addColumn(Dialect $dialect, string $field_name, string $value, ?string ...$data) :  self
    {
        $this->columns[$field_name] = $this->getBindedString($dialect, $value, ...$data);
        return $this;
    }

    /**
     * This function adds a column to the select statement
     * 
     * @param Dialect dialect The dialect to use.
     * @param string field_name The name of the column to be added.
     * @param Select select The Select object that you want to add to the select statement.
     * @param bool json If true, the column will be treated as a JSON column.
     * 
     * @return The column name.
     */

    public function addColumnSelect(Dialect $dialect, string $field_name, Select $select, bool $json = false) : self
    {
        $statement_connection = $select->getConnection();
        $statement = new Statement($statement_connection);
        $statement->append('SELECT');

        if (true !== $json) {
            $statement->append(chr(42));
        } else {
            $table_column = $dialect::ToJSON($select);
            $statement->append($table_column);
        }

        $statement->append('FROM');

        $statement_from = $select->getStatement();
        $this->pushFromBind($statement_from);

        $statement_from = $statement_from->get();
        $statement_from = chr(40) . $statement_from . chr(41);
        $statement->append($statement_from);
        $statement->append('AS');
        $statement_from = $select->getFrom();
        $statement->append($statement_from);

        $this->columns[$field_name] = $statement->get();
        $this->columns[$field_name] = chr(40) . $this->columns[$field_name] . chr(41);

        return $this;
    }

    /**
     * This function will return an array of the columns that are being used in the query
     * 
     * @param int type The type of the column.
     * @param prefix The prefix to use for the bind variables.
     * 
     * @return The return value is an array of strings.
     */

    public function getColumnsParsed(int $type, ?string $prefix = null) : array
    {
        $list = [];
        $bind = $this->getBind();
        $columns = $this->getColumns();

        $curerrent_contants = static::getConstants(static::class);
        if (false === in_array($type, $curerrent_contants))
            throw new CustomException('developer/database/ksql/injection/column/parse/type');

        foreach ($columns as $key => $value) {
            $name = chr(96) . $key . chr(96);
            if (null !== $prefix)
                $name = chr(96) . $prefix . chr(96) . chr(46) . $name;

            $list[$key] = $replace = preg_replace('/' . static::BIND_NAME . '/', $name, $value);
            $list[$key] = preg_replace('/^\[(.*)\]$/', '$1', $list[$key]);
            $expression = static::WHERE !== $type
                ? $name . '$'
                : chr(40) . '^\(?' . $name . chr(41) . '|' . chr(40) . '^\[.*\]$' . chr(41);
            if (static::CLEAN === $type
                || preg_match('/' . $expression . '/', $replace)) continue;

            $list[$key] = static::FIELD !== $type
                ? $name . chr(32) . '=' . chr(32) . $list[$key]
                : $list[$key] . chr(32) . 'AS' . chr(32) . $name;
        }

        return $list;
    }
}
