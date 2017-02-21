<?php

namespace Algorithm\Graph;

/**
 * Class Vertex
 * @package Algorithm\Graph
 */
class Vertex
{
    /**
     * @var mixed
     */
    public $key;

    /**
     * @var string|null
     */
    public $color;

    /**
     * @var int|null
     */
    public $depth;

    /**
     * @var int
     */
    public $start;

    /**
     * @var int
     */
    public $finish;

    /**
     * @var int
     */
    public $shortestPathEstimate;

    /**
     * @var Vertex|null
     */
    public $parent;

    /**
     * @param mixed $key
     * @param null|string $color
     * @param null|int $depth
     * @param null|int $start
     * @param null|int $finish
     * @param null|int $shortestPathEstimate
     * @param null|Vertex $parent
     */
    public function __construct($key, $color = null, $depth = null, $start = null, $finish = null, $shortestPathEstimate = null, $parent = null)
    {
        $this->key = $key;
        $this->color = $color;
        $this->depth = $depth;
        $this->start = $start;
        $this->finish = $finish;
        $this->shortestPathEstimate = $shortestPathEstimate;
        $this->parent = $parent;
    }
}