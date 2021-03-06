<?php


namespace Training\Tests\Helpers;

/**
 * Class CsvDatasourceFileIterator
 *
 * @package Training\Tests\Helpers
 */
class CsvDatasourceFileIterator implements \Iterator
{

    /**
     * @var bool|resource
     */
    protected $file;

    /**
     * @var int
     */
    protected $key = 0;

    /**
     * @var array
     */
    protected $current;

    /**
     * CsvDatasourceFileIterator constructor.
     *
     * @param $file
     */
    public function __construct($file) {

        $dir = ROOT_DIR. "/tests/Datasources/";
        $filePath = $dir . $file;

        $this->file = fopen($filePath, 'r');
    }

    /**
     *
     */
    public function __destruct() {
        fclose($this->file);
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->current = fgetcsv($this->file);
        $this->key++;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return !feof($this->file);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        rewind($this->file);
        $this->current = fgetcsv($this->file);
        $this->key = 0;
    }
}