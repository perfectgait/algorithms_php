<?php

require_once 'bootstrap.php';

use Algorithm\DataStructure\VertexMinHeap;
use Algorithm\Factory\GraphFactory;
use Algorithm\Graph\Graph;
use Algorithm\Graph\Vertex;
use Algorithm\Helper\GraphHelper;

/**
 * The running time of Dijkstra's is V^2 and the space complexity is V
 */

/**
 * This works by first updating all vertices shortest path estimate and parent to null.  Then the shortest path estimate
 * of the source is set to 0 (naturally because we start at the source).
 * After this the algorithm inserts all nodes into a min heap (keyed off of the shortest path estimate).
 * After this the algorithm iterates over all nodes in the heap, starting with the source (because the source was
 * initialized to have a shortest path estimate of 0).  In each iteration the current node is added to a set of nodes
 * which have had their shortest path estimate finalized.  Then all of the adjacent edges for the current node are
 * relaxed.  When all of the nodes have been iterated, the algorithm is done.
 *
 * Dijkstra's algorithm will not work with a graph that contains negative edge weights.
 *
 * @see https://en.wikipedia.org/wiki/Dijkstra's_algorithm
 * @param Graph $graph
 * @param callable $weightFunction
 * @param Vertex $extractedVertex
 * @return array
 */
function computeShortestPaths(Graph $graph, callable $weightFunction, Vertex $extractedVertex)
{
    GraphHelper::initializeSingleSource($graph, $extractedVertex);

    $shortestComputedPaths = [];
    $minHeap = new VertexMinHeap();

    foreach ($graph->vertices as $vertex) {
        $minHeap->insert($vertex);
    }

    while (!$minHeap->isEmpty()) {
        /** @var Vertex $extractedVertex */
        $extractedVertex = $minHeap->extract();
        $shortestComputedPaths[] = $extractedVertex;

        foreach ($graph->adjacencyList[$extractedVertex->key] as $adjacentVertexKey => $edgeWeight) {
            GraphHelper::relax($extractedVertex, $graph->vertices[$adjacentVertexKey], $weightFunction);
        }
    }

    return $shortestComputedPaths;
}

$adjacencyList = [
    's' => ['t' => 10, 'y' => 5],
    't' => ['x' => 1, 'y' => 2],
    'x' => ['z' => 4],
    'y' => ['t' => 3, 'x' => 9, 'z' => 2],
    'z' => ['s' => 7, 'x' => 6],
];
$graph = GraphFactory::makeGraphFromAdjacencyList($adjacencyList);
$weightFunction = function(Vertex $source, Vertex $destination) use ($graph) {
    return $graph->adjacencyList[$source->key][$destination->key];
};
$shortestComputedPaths = computeShortestPaths($graph, $weightFunction, $graph->vertices['s']);

foreach ($shortestComputedPaths as $vertex) {
    $shortestPath = [];
    /** @var Vertex $vertex */
    $parent = $vertex;
    $weight = $parent->shortestPathEstimate;

    while ($parent) {
        $shortestPath[] = $parent->key;
        $parent = $parent->parent;
    }

    $pathString = implode('->', array_reverse($shortestPath));

    printf('A shortest path to vertex %s from %s is %s with weight %d.', $vertex->key, 's', $pathString, $weight);
    print PHP_EOL;
}