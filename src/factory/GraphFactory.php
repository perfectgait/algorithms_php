<?php

namespace Algorithm\Factory;

use Algorithm\Graph\Graph;
use Algorithm\Graph\Vertex;

/**
 * Class GraphFactory
 * @package Algorithm\Factory
 */
class GraphFactory
{
    /**
     * @param array $adjacencyList
     * @return Graph
     */
    public static function makeGraphFromAdjacencyList(array $adjacencyList)
    {
        $vertices = [];

        foreach ($adjacencyList as $key => $adjacentVertexes) {
            $vertices[$key] = new Vertex($key);
        }

        return new Graph($vertices, $adjacencyList);
    }
}