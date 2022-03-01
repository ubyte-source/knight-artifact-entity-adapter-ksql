<?PHP

namespace KSQL\operations\select\group;

use Knight\armor\CustomException;

use KSQL\entity\Table;
use KSQL\operations\common\Option;
use KSQL\operations\Select;

/* This class is used to group the results of a query by a list of fields */

class Collection extends Option
{
    protected $fields = []; // (array)

    /**
     * The constructor takes a table and a list of fields and sets them as the fields of the object
     * 
     * @param Table table The table to which the query will be applied.
     */

    public function __construct(Table $table, string ...$fields)
    {
        parent::__construct($table);
        $this->setFields(...$fields);
    }

   /**
    * This function sets the fields that will be group statement in the query
    * 
    * @return The object itself.
    */

    public function setFields(string ...$fields) : self
    {
        $table = $this->getTable()->getAllFieldsKeys();
        $fields_unique = array_intersect($fields, $table);
        $fields_unique = array_unique($fields_unique, SORT_STRING);
        if (empty($fields_unique))
            throw new CustomException('developer/database/ksql/operations/select/group/collection/field');

        $this->fields = $fields_unique;

        return $this;
    }

    /**
     * Returns an array of the fields in the table
     * 
     * @return An array of field names.
     */

    public function getFields() : array
    {
        return $this->fields;
    }

    /**
     * This function returns an array of the columns that are in the table that this field is in
     * 
     * @param select The Select object that is being elaborated.
     * 
     * @return An array of column names.
     */

    public function elaborate(?Select $select) : array
    {
        $fields = $this->getFields();
        $fields = array_fill_keys($fields, null);
        if (null === $select) return $fields;

        $table = $this->getTable();
        $table_dialect = $select->getConnection()->getDialect();
        $table_columns = $select->getAllColumns($table_dialect, $table);
        $table_columns = array_intersect_key($table_columns, $fields);

        return $table_columns;
    }
}