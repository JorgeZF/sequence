<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 06/09/15
 * Time: 20:23
 */

namespace Revinate\Sequence\Tutorial\util;

use ReturnTypeWillChange;

class StreamReaderIterator implements \Iterator {

    /** @var  resource */
    protected $resource;
    protected $isValid;
    protected $current = null;
    protected $lineNumber = 0;

    /**
     * AbstractStreamReader constructor.
     * @param resource $resource
     */
    public function __construct($resource) {
        $this->resource = $resource;
        $this->isValid  = ! feof($resource);
    }

    /**
     * @description close the handle when we go away.
     */
    public function __destruct() {
        fclose($this->resource);
    }

    #[ReturnTypeWillChange] public function next() {
        $this->current = null;
        $this->isValid = ! feof($this->resource);
        ++$this->lineNumber;
    }

    #[ReturnTypeWillChange] public function valid() {
        return $this->isValid;
    }

    #[ReturnTypeWillChange] public function rewind() {
        if (rewind($this->resource)) {
            $this->lineNumber = 0;
        }
    }
    #[ReturnTypeWillChange] public function current() {
        if (is_null($this->current)) {
            $this->current = fgets($this->resource);
        }
        if ($this->current === false) {
            $this->isValid = false;
        }
        return $this->current;
    }

    #[ReturnTypeWillChange] public function key() {
        return $this->lineNumber;
    }
}
