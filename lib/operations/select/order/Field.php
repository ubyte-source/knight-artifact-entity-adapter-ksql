<?PHP

namespace KSQL\operations\select\order;

use Knight\armor\CustomException;

use KSQL\entity\Table;
use KSQL\operations\Select;
use KSQL\operations\select\order\base\Column;

class Field extends Column
{
    protected $options = []; // (array)

    public function __construct(Table $table, string $name)
    {
        parent::__construct($table, $name);
    }

    public function setOptions(string ...$options) : self
    {
        $options_unique = array_unique($options, SORT_STRING);
        if (empty($options_unique)) throw new CustomException('developer/database/ksql/operations/select/order/field/option');
        $this->options = $options_unique;
        return $this;
    }

    public function getOptions() : array
    {
        return $this->options;
    }

    public function elaborate(?Select $select) : string
    {
        $field = $this->getNameElaborate($select);

        $options = $this->getOptions();
        $options = preg_filter('/^.*$/', chr(34) . '$0' . chr(34), $options);
        $options = implode(chr(44) . chr(32), $options);
        $options = $field . chr(44) . chr(32) . $options;
        $options = 'FIELD' . chr(40) . $options . chr(41);

        return $options;
    }
}