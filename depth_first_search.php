<?php

require_once 'bootstrap.php';

use Algorithm\Graph\Graph;
use Algorithm\Graph\Vertex;
use Algorithm\Factory\GraphFactory;
use Algorithm\Helper\GraphHelper;

/**
 * The running time of depth first search is O(E + V) and the space complexity is O(V) where V is the cardinality
 * of the set of vertices.
 */

$time = 0;

/**
 * This works by first marking the current node as grey to indicate that it was visited but not explored.  It also
 * records the start "time" for the current node.  Then, each adjacent node to the current node is checked to see if it
 * has been visited.  If not, it's parent is marked as the current node and the method is recursively called with the
 * adjacent node as the current node.  When all adjacent nodes and their children have been explored, the current node
 * is marked as black to indicate that it has been fully explored and the finish "time" is recorded.  At the end of the
 * process all nodes have been explored, have a parent, have a color of black and a start and finish "time."
 *
 * DFS cannot be used to find the shortest distance between two nodes.
 *
 * @see https://en.wikipedia.org/wiki/Depth-first_search for a detailed description of how this works.  Writing it out
 * here will take a long time and quite frankly I don't feel like it.
 * @param Graph $graph
 * @param Vertex $node
 */
function depthFirstSearch(Graph &$graph, Vertex $node)
{
    global $time;
    $time += 1;
    $node->start = $time;
    $node->color = 'grey';

    if (isset($graph->adjacencyList[$node->key]) && !empty($graph->adjacencyList[$node->key])) {
        foreach ($graph->adjacencyList[$node->key] as $adjacentVertexKey) {
            if ($graph->vertices[$adjacentVertexKey]->color === 'white') {
                $graph->vertices[$adjacentVertexKey]->parent = $node;
                depthFirstSearch($graph, $graph->vertices[$adjacentVertexKey]);
            }
        }
    }

    $node->color = 'black';
    $time += 1;
    $node->finish = $time;
}

$adjacencyList = [
    'v' => ['r'],
    'r' => ['v', 's'],
    's' => ['r', 'w'],
    'w' => ['s', 'x', 't'],
    'x' => ['w', 't', 'u', 'y'],
    't' => ['w', 'x', 'u'],
    'u' => ['t', 'x', 'y'],
    'y' => ['x', 'u']
];
$graph = GraphFactory::makeGraphFromAdjacencyList($adjacencyList);
GraphHelper::prepareGraphForDepthFirstSearch($graph);
depthFirstSearch($graph, $graph->vertices['s']);
var_dump($graph->vertices);