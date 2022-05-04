<?PHP

namespace KSQL\operations\common;

use KSQL\Initiator;
use KSQL\operations\common\features\Parser;

/* A contract that all the operation classes must follow. */

interface Run
{
    public function run();
}

/* The Base class is the parent class of all operation class */

abstract class Base implements Run
{
    use Parser;

    protected $core; // Initiator

    /**
     * It clones the object and all of its properties
     * 
     * @return Nothing.
     */

    final public function __clone()
    {
        $variables = get_object_vars($this);
        $variables = array_keys($variables);
        $variables_glue = [];
        foreach ($variables as $name) array_push($variables_glue, array(&$this->$name));
        array_walk_recursive($variables_glue, function (&$item, $name) {
            if (false === is_object($item)) return;
            $clone = clone $item;
        });
    }

    /**
     * The __construct function is called when a new instance of the class is created
     * 
     * @param Initiator core The core object.
     * @param array arguments An array of arguments passed to the constructor.
     */

    final public function __construct(Initiator $core, array $arguments)
    {
        $this->setCore($core);
        if (method_exists($this, 'initialize')) $this->initialize(...$arguments);
    }

    /**
     * The setCore function is a protected function that takes an Initiator object as a parameter and
     * sets the core property of the class to the Initiator object
     * 
     * @param Initiator core The core object that is used to access the database.
     */

    final protected function setCore(Initiator $core) : void
    {
        $this->core = $core;
    }

    /**
     * This function returns the Initiator object that is used to access the core functionality of the
     * framework
     * 
     * @return The Initiator object.
     */

    final protected function getCore() : Initiator
    {
        return $this->core;
    }
}