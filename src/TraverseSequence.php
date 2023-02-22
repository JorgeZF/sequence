<?php

namespace Revinate\Sequence;

class TraverseSequence extends RecursiveSequence {
    protected $path;
    protected $pathSeparator = '.';

    /**
     * @param $iterator
     * @param null|string $path
     * @param string $pathSeparator
     * @return TraverseSequence
     */
    public static function make($iterator, $path = null, $pathSeparator = '.') {
        /** @var TraverseSequence $traverseSequence */
        $traverseSequence = parent::make($iterator);
        $traverseSequence->pathSeparator = $pathSeparator;
        $traverseSequence->path = is_null($path) ? '' : $path . $pathSeparator;
        return $traverseSequence;
    }

    public function getChildren(): TraverseSequence|MappedSequence {
        $x = $this->current();
        if ($this->canGoDeeper()) {
            return self::make($x, $this->key(), $this->pathSeparator)->setMaxDepth($this->depth - 1);
        } else {
            return IterationTraits::map(
                Sequence::make($x),
                FnGen::fnIdentity(),
                FnString::fnAddPrefix($this->key() . $this->pathSeparator)
            );
        }
    }

    public function key(): string {
        $key = parent::key();
        return $this->path . $key;
    }
}
