<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 24/07/2015
 * Time: 16:54
 */

namespace Revinate\Sequence;


use Closure;
use Iterator;

class OnDemandIterator implements Iterator {
    /** @var  Closure|callable */
    protected $fnGetIterator;
    protected ?Iterator $iterator = null;

    public function __construct($fnGetIterator) {
        $this->fnGetIterator = $fnGetIterator;
    }

    /**
     * @return Iterator|null
     */
    public function getIterator(): ?Iterator
    {
        if (is_null($this->iterator)) {
            $fn = $this->fnGetIterator;
            $this->iterator = $fn();
        }

        return $this->iterator;
    }

    public function current(): mixed {
        return $this->getIterator()->current();
    }

    public function next(): void {
        $this->getIterator()->next();
    }

    public function key(): mixed {
        return $this->getIterator()->key();
    }

    public function valid(): bool {
        return $this->getIterator()->valid();
    }

    public function rewind(): void {
        $this->getIterator()->rewind();
    }
}
