<?PHP

namespace KSQL\adapters\map\common;

use Knight\armor\CustomException;

use KSQL\dialects\constraint\Dialect;

/* This class is used to bind values to a query */

class Bind
{
    const BIND_VARIABLE_PREFIX = '\\$';
    const BIND_VARIABLE_PREFIX_ASSOCIATIVE = 'i';

    protected $bind = [];            // (array)
    protected static $increment = 0; // (int)

    /**
     * This function returns the bind array
     * 
     * @return An array of values that are bound to the query.
     */

    public function getBind() : array
    {
        return $this->bind; /// value parse
    }

    /**
     * This function resets the bind array
     * 
     * @return The object itself.
     */

    public function resetBind() : self
    {
        $this->bind = array();
        return $this;
    }

    /**
     * This function returns an array of bind variables that are bound to the data passed in
     * 
     * @return An array of bound variables.
     */

    public function getBound(...$data) : array
    {
        $bind = $this->getBind();
        $bind_bound = [];
        foreach ($data as $key => $value) {
            $bind_count = static::increment();
            $bind_bound[$key] = static::BIND_VARIABLE_PREFIX_ASSOCIATIVE . $bind_count;
            $this->bind[$bind_bound[$key]] = $value;
        }
        return $bind_bound;
    }

    /**
     * Add a bind value to the query
     * 
     * @param string key The name of the variable to bind.
     * @param data The data to be bound to the query.
     * 
     * @return Nothing.
     */

    public function addBind(string $key, $data) : self
    {
        if (array_key_exists($key, $this->bind)
            && $this->bind[$key] !== $data)
                throw new CustomException('developer/database/bind/alredy/value');

        $this->bind[$key] = $data;

        return $this;
    }

    /**
     * This function takes an array of binds and adds them to the current bind
     * 
     * @return Nothing.
     */

    public function pushFromBind(self ...$binds) : self
    {
        array_walk($binds, function (self $bind) {
            $bind_value = $bind->getBind();
            foreach ($bind_value as $key => $value) $this->addBind($key, $value);
        });
        return $this;
    }

    /**
     * It takes a string, finds all the placeholders in it, and replaces them with the values from the
     * array
     * 
     * @param Dialect dialect The dialect object to use.
     * @param string value The string to be binded.
     * 
     * @return string A string with the binded values.
     */

    protected function getBindedString(Dialect $dialect, string $value, ?string ...$data) : string
    {
        $bound = $this->getBound(...$data);
        $value_expression_separator = $dialect::BindCharacter();
        $value_expression = chr(47) . static::BIND_VARIABLE_PREFIX . chr(40) . '\\' . chr(100) . chr(43) . chr(41) . chr(47);
        $value_binded = preg_replace_callback($value_expression, function ($match) use ($bound, $value_expression_separator) {
            return array_key_exists($match[1], $bound)
                ? $value_expression_separator . $bound[$match[1]]
                : $match[0];
        }, $value);

        return $value_binded;
    }

    /**
     * Increment the static variable by 1
     * 
     * @return The return value is an integer that is incremented by 1 each time the function is called.
     */

    private static function increment() : int
    {
        return static::$increment++;
    }
}