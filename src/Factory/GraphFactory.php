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
        $edges = [];

        foreach ($adjacencyList as $key => $adjacentVertexes) {
            $vertices[$key] = new Vertex($key);

            foreach ($adjacentVertexes as $adjacentKey => $adjacentWeight) {
                $edges[] = [$key, $adjacentKey];
            }
        }

        return new Graph($vertices, $adjacencyList, $edges);
    }
}