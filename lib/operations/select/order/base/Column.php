<?PHP

namespace KSQL\operations\select\order\base;

use KSQL\entity\Table;
use KSQL\operations\common\Option;
use KSQL\operations\Select;

/* This is an interface that is used to define the `elaborate` function. */

interface Elaborate
{
    public function elaborate(?Select $select) : string;
}

/* The Column class is an abstract class that represents a column in a table */

abstract class Column extends Option implements Elaborate
{
    protected $name; // (string)

    /**
     * The constructor for the class
     * 
     * @param Table table The table object that this column belongs to.
     * @param string name The name of the column.
     */

    public function __construct(Table $table, string $name)
    {
        parent::__construct($table);
        $this->setName($name);
    }

    /**
     * "Get the name of the column."
     * 
     * @return The name of the object.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the name of the column, with a prefix of the table name if the column is not in the
     * group
     * 
     * @param select The Select object that is being built.
     * 
     * @return The field name, with a preceding underscore, if the field is not in the group.
     */

    public function getNameElaborate(?Select $select) : string
    {
        $field = $this->getName();
        $field_elaborate = chr(96) . $field. chr(96);
        if (null === $select) return $field;

        $table = $this->getTable();
        $table_columns = $select->getAllColumns($table);
        if (array_key_exists($field, $table_columns))
            $field_elaborate = $table_columns[$field];

        $group = $select->getGroup()->getColumns(null, true);
        if (empty($group)
            || in_array($field, $group)) return $field_elaborate;
    
        $connection_dialect = $select->getConnection()->getDialect();
        $any = $connection_dialect::AnyValue($field_elaborate);

        return $any;
    }

    /**
     * This function sets the name of the column to be ordered
     * 
     * @param string name The name of the column to order by.
     */

    protected function setName(string $name) : void
    {
        $table = $this->getTable()->getAllFieldsKeys();
        if (false === in_array($name, $table))
            throw new CustomException('developer/database/ksql/operations/select/order/column');

        $this->name = $name;
    }
}
