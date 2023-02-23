<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 06/09/15
 * Time: 20:23
 */

namespace Revinate\Sequence\Tutorial\util;

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

    public function next(): void {
        $this->current = null;
        $this->isValid = ! feof($this->resource);
        ++$this->lineNumber;
    }

    public function valid(): bool {
        return $this->isValid;
    }

    public function rewind(): void {
        if (rewind($this->resource)) {
            $this->lineNumber = 0;
        }
    }
    public function current(): mixed {
        if (is_null($this->current)) {
            $this->current = fgets($this->resource);
        }
        if ($this->current === false) {
            $this->isValid = false;
        }
        return $this->current;
    }

    public function key(): mixed {
        return $this->lineNumber;
    }
}
