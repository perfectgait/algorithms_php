<?php

namespace Algorithm\Graph;

/**
 * Class Graph
 * @package Algorithm\Graph
 */
class Graph
{
    /**
     * @var array
     */
    public $vertices;

    /**
     * @var array
     */
    public $adjacencyList;

    /**
     * @var array
     */
    public $edges;

    /**
     * @param array $vertices
     * @param array $adjacencyList
     * @param array $edges
     */
    public function __construct(array $vertices, array $adjacencyList, array $edges)
    {
        $this->vertices = $vertices;
        $this->adjacencyList = $adjacencyList;
        $this->edges = $edges;
    }
}