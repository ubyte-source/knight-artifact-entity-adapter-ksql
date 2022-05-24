<?PHP

namespace KSQL\operations\select\order;

use Knight\armor\CustomException;

use KSQL\entity\Table;
use KSQL\operations\Select;
use KSQL\operations\select\order\base\Column;

/* This class is used to set the direction of the order by clause */

class Direction extends Column
{
    const ASC = 0x2143a;
    const DESC = 0x21408;

    protected $direction; // (int)

    /**
     * The constructor for the class takes a table and a name, and sets the direction to ascending
     * 
     * @param Table table The table object that this column belongs to.
     * @param string name The name of the column.
     */

    public function __construct(Table $table, string $name)
    {
        parent::__construct($table, $name);
        $this->setDirection(static::ASC);
    }

    /**
     * Set the direction of the order by clause.
     * 
     * @param int direction The direction of the order.
     * 
     * @return Nothing.
     */

    public function setDirection(int $direction) : self
    {
        $constants = static::getConstants(static::class);
        if (false === in_array($direction, $constants))
            throw new CustomException('developer/database/ksql/operations/select/order/direction');

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get the direction of the column.
     * 
     * @return The direction of the column.
     */

    public function getDirection() : int
    {
        return $this->direction;
    }

    /**
     * This function returns the direction of the field
     * 
     * @param select The Select object that is currently being elaborated.
     * 
     * @return The direction of the field.
     */

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
