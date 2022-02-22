<?PHP

namespace KSQL\operations\select\order;

use Knight\armor\CustomException;

use KSQL\entity\Table;
use KSQL\operations\Select;
use KSQL\operations\select\order\base\Column;

class Direction extends Column
{
    const ASC = 0x2143a;
    const DESC = 0x21408;

    protected $direction; // (int)

    public function __construct(Table $table, string $name)
    {
        parent::__construct($table, $name);
        $this->setDirection(static::ASC);
    }

    public function setDirection(int $direction) : self
    {
        $constants = static::getConstants(static::class);
        if (false === in_array($direction, $constants)) throw new CustomException('developer/database/ksql/operations/select/order/direction');
        $this->direction = $direction;
        return $this;
    }

    public function getDirection() : int
    {
        return $this->direction;
    }

    public function elaborate(?Select $select) : string
    {
        $field = $this->getNameElaborate($select);

        $curerrent_contants = static::getConstants(static::class);
        $direction = $this->getDirection();
        $direction = array_search($direction, $curerrent_contants, true);
        $direction = $field . chr(32) . $direction;

        return $direction;
    }
}