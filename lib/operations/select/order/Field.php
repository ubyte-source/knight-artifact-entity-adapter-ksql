<?PHP

namespace KSQL\operations\select\order;

use Knight\armor\CustomException;

use KSQL\entity\Table;
use KSQL\operations\Select;
use KSQL\operations\select\order\base\Column;

/* This class is used to create a field in a select statement */

class Field extends Column
{
    protected $options = []; // (array)

    /**
     * Constructor for the class
     * 
     * @param Table table The table that this column belongs to.
     * @param string name The name of the column.
     */

    public function __construct(Table $table, string $name)
    {
        parent::__construct($table, $name);
    }

   /**
    * This function sets the options for the field
    * 
    * @return Nothing.
    */

    public function setOptions(string ...$options) : self
    {
        $options_unique = array_unique($options, SORT_STRING);
        if (empty($options_unique)) throw new CustomException('developer/database/ksql/operations/select/order/field/option');
        $this->options = $options_unique;
        return $this;
    }

    /**
     * This function returns the options array
     * 
     * @return An array of options.
     */

    public function getOptions() : array
    {
        return $this->options;
    }

   /**
    * This function returns the options for the field
    * 
    * @param select The Select object that is currently being elaborated.
    * 
    * @return The field name and the options.
    */

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