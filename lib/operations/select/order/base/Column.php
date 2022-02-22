<?PHP

namespace KSQL\operations\select\order\base;

use KSQL\entity\Table;
use KSQL\operations\common\Option;
use KSQL\operations\Select;

interface Elaborate
{
    public function elaborate(?Select $select) : string;
}

abstract class Column extends Option implements Elaborate
{
    protected $name; // (string)

    public function __construct(Table $table, string $name)
    {
        parent::__construct($table);
        $this->setName($name);
    }

    public function getName() : string
    {
        return $this->name;
    }

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

    protected function setName(string $name) : void
    {
        $table = $this->getTable()->getAllFieldsKeys();
        if (false === in_array($name, $table))
            throw new CustomException('developer/database/ksql/operations/select/order/column');

        $this->name = $name;
    }
}