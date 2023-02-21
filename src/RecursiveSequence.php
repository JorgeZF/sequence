<?php
namespace Revinate\Sequence;

use \RecursiveIterator;

class RecursiveSequence extends Sequence implements RecursiveIterator  {
    protected $depth = -1;

    public function canGoDeeper() {
        return ($this->depth - 1) !== 0;
    }

    /**
     * @return RecursiveIterator|null
     */
    public function getChildren(): ?RecursiveIterator {
        $x = $this->current();
        if ($this->canGoDeeper()) {
            return self::make($x)->setMaxDepth($this->depth - 1);
        } else {
            return Sequence::make($x);
        }
    }

    /**
     * @param $depth
     * @return $this
     */
    public function setMaxDepth($depth = -1) {
        $this->depth = $depth;
        return $this;
    }

    /**
     * @return bool - true if we can make a sequence out of the current item.
     */
    public function hasChildren(): bool {
        return $this->valid() && $this->depth != 0 && self::canBeSequence($this->current());
    }
}
