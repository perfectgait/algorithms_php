<?php

require_once 'bootstrap.php';

use Algorithm\Graph\Graph;
use Algorithm\Graph\Vertex;
use Algorithm\Factory\GraphFactory;
use Algorithm\Helper\GraphHelper;

/**
 * The running time of Bellman Ford is O(V * E) and the space complexity is O(1)
 */

/**
 * This works by first updating all vertices shortest path estimate and parent to null.  Then the shortest path estimate
 * of the source is set to 0 (naturally because we start at the source).
 * After this the algorithm makes V - 1 iterations over all of the edges and relaxes them.  It makes V - 1 iterations
 * because to properly relax the edges, the source vertex in each edge must have a shortest path estimate.  During the
 * first iteration, only the source vertex has a shortest path estimate and so only the edges that are formed from the
 * source vertex can be relaxed.
 * After all of the edges have been relaxed, the edges are iterated again to see if relaxing the edge again would
 * produce a cheaper shortest path estimate.  If so, a negative cycle exists.
 *
 * @see https://en.wikipedia.org/wiki/Bellman%E2%80%93Ford_algorithm
 * @param Graph $graph
 * @param callable $weightFunction
 * @param Vertex $source
 * @return boolean
 */
function bellmanFord(Graph &$graph, callable $weightFunction, Vertex $source)
{
    GraphHelper::initializeSingleSource($graph, $source);

    for ($i = 0; $i < count($graph->vertices) - 1; $i++) {
        // Iterate over all the edges
        foreach ($graph->edges as $edge) {
            relax($graph->vertices[$edge[0]], $graph->vertices[$edge[1]], $weightFunction);
        }
    }

    foreach ($graph->edges as $edge) {
        if ($graph->vertices[$edge[0]]->shortestPathEstimate > $graph->vertices[$edge[1]]->shortestPathEstimate + $weightFunction($graph->vertices[$edge[0]], $graph->vertices[$edge[1]])) {
            return false;
        }
    }

    return true;
}

/**
 * Relax an edge by comparing the destination vertex's shortest path estimate against the sources shortest path estimate
 * + the weight of the edge.  If the source's shortest path estimate + the weight of the edge is less than the
 * destination's shortest path estimate, there is a shorter path to the destination.  Because a shorter path exists, the
 * destination's shortest path estimate is updated to the value of the source's shortest path estimate + the weight of
 * the edge.
 *
 * @param Vertex $source
 * @param Vertex $destination
 * @param callable $weightFunction
 */
function relax(Vertex $source, Vertex $destination, callable $weightFunction)
{
    if (!is_null($source->shortestPathEstimate)
        && (is_null($destination->shortestPathEstimate)
        || $destination->shortestPathEstimate > $source->shortestPathEstimate + $weightFunction($source, $destination))
    ) {
        $destination->shortestPathEstimate = $source->shortestPathEstimate + $weightFunction($source, $destination);
        $destination->parent = $source;
    }
}

$adjacencyList = [
    's' => ['t' => 6, 'y' => 7],
    't' => ['x' => 5, 'y' => 8, 'z' => -4],
    'x' => ['t' => -2],
    'y' => ['x' => -3, 'z' => 9],
    'z' => ['s' => 2, 'x' => 7],
];
$graph = GraphFactory::makeGraphFromAdjacencyList($adjacencyList);
$weightFunction = function(Vertex $source, Vertex $destination) use ($graph) {
    return $graph->adjacencyList[$source->key][$destination->key];
};
$result = bellmanFord($graph, $weightFunction, $graph->vertices['s']);

if ($result) {
    print 'There is not a negative-weight cycle that is reachable from vertex s.';
} else {
    print 'There is a negative-weight cycle that is reachable from vertex s.';
}

print PHP_EOL;
var_dump($graph);
