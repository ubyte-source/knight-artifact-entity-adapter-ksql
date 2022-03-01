<?PHP

namespace KSQL\operations\select;

/* Limit is a class that can be used to set the limit and offset of a query */

class Limit
{
    protected $limit;  // (int)
    protected $offset; // (int)

    /**
     * Set the limit of the query.
     * 
     * @param int limit The maximum number of results to return.
     * 
     * @return Nothing.
     */

    public function set(int $limit) : self
    {
        $this->limit = $limit;
        return $this;
    }

   /**
    * Get the value of the limit property.
    * 
    * @return The limit value.
    */

    public function get() :? int
    {
        return $this->limit;
    }

    /**
     * Set the offset of the current status
     * 
     * @param int offset The number of seconds to offset the time by.
     * 
     * @return Nothing.
     */

    public function setOffset(int $offset) : self
    {
        $offset = abs($offset);
        $status = $this->get();
        if (null === $status) $this->set($offset);

        $this->offset = $offset;
        return $this;
    }

    /**
     * Get the offset of the current position in the file.
     * 
     * @return The offset of the current position in the file.
     */

    public function getOffset() :? int
    {
        return $this->offset;
    }
}