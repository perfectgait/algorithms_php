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
     * @param array $vertices
     * @param array $adjacencyList
     */
    public function __construct(array $vertices, array $adjacencyList)
    {
        $this->vertices = $vertices;
        $this->adjacencyList = $adjacencyList;
    }
}