<?php
/**
 * Created by PhpStorm.
 * User: jasondent
 * Date: 20/03/15
 * Time: 13:08
 */

class FilteredSequence extends FilterIterator implements  IterationFunctions {
    protected $fnFilterFunction = null;

    /**
     * @param Iterator $iterator
     * @param callable $fnFilterFunction($value, $key) - returns bool - true to keep, false to throw away.
     */
    public function __construct(Iterator $iterator, Closure $fnFilterFunction) {
        parent::__construct($iterator);
        $this->fnFilterFunction = $fnFilterFunction;
    }

    /**
     * Necessary to support FilterIterator - true = keep, false = skip
     * @return bool
     */
    public function accept() {
        /** @var Closure $fn */
        $fn = $this->fnFilterFunction;
        return $fn($this->current(), $this->key());
    }

    /**
     * @param callable $fnValueMap($value, $key) -- function that returns the new value.
     * @param callable $fnKeyMap($key, $value) [optional] -- function that returns the new key
     * @return MappedSequence
     */
    public function map(Closure $fnValueMap, Closure $fnKeyMap = null) {
        return IterationTraits::map($this, $fnValueMap, $fnKeyMap);
    }

    /**
     * @param callable $fn
     * @return FilteredSequence
     */
    public function filter(Closure $fn) {
        return IterationTraits::filter($this, $fn);
    }

    /**
     * @param $init
     * @param callable $fn($reducedValue, $value, $key)
     * @return mixed
     */
    public function reduce($init, Closure $fn) {
        return IterationTraits::reduce($this, $init, $fn);
    }

    /**
     * Get the keys
     * @return MappedSequence
     */
    public function keys() {
        return IterationTraits::keys($this);
    }

    /**
     * Get the values
     *
     * @return MappedSequence
     */
    public function values() {
        return IterationTraits::values($this);
    }

    /**
     * Convert to an array.
     * @return array
     */
    public function to_a() {
        return IterationTraits::to_a($this);
    }

    /**
     * calls $fn for every value,key pair
     *
     * @param callable $fn($value, $key)
     * @return Iterator
     */
    public function walk(Closure $fn) {
        return IterationTraits::walk($this, $fn);
    }
}