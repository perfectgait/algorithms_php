<?php

require_once 'bootstrap.php';

use Algorithm\Graph\Graph;
use Algorithm\Graph\Vertex;
use Algorithm\Factory\GraphFactory;
use Algorithm\Helper\GraphHelper;

/**
 * The running time of breadth first search is O(E + V) and the space complexity is O(V) where V is the cardinality
 * of the set of vertices.
 */

/**
 * This works by first coloring the starting node grey to indicate that it has been visited but not fully explored.
 * Each node that is adjacent to the starting node is then visited and after they have all been visited the starting
 * node is colored black.  The same process then repeats for each node that was adjacent to the starting node until all
 * nodes have been colored black.  After all of the nodes have been colored black, they will each have a depth and chain
 * of parents which can be used to find an optimal path back to the starting node.
 *
 * BFS will find the shortest distance between two nodes in an unweighted graph.
 *
 * @see https://en.wikipedia.org/wiki/Breadth-first_search for a detailed description of how this works.  Writing it out
 * here will take a long time and quite frankly I don't feel like it.
 * @param Graph $graph
 * @param Vertex $start
 */
function breadthFirstSearch(Graph &$graph, Vertex $start)
{
    $start->color = 'grey';
    $start->depth = 0;
    $start->parent = null;

    $queue = new \SplQueue();
    $queue->enqueue($start);

    while (!$queue->isEmpty()) {
        /** @var Vertex $vertex */
        $vertex = $queue->dequeue();

        if (isset($graph->adjacencyList[$vertex->key]) && !empty($graph->adjacencyList[$vertex->key])) {
            foreach ($graph->adjacencyList[$vertex->key] as $adjacentVertexKey) {
                if ($graph->vertices[$adjacentVertexKey]->color === 'white') {
                    $graph->vertices[$adjacentVertexKey]->color = 'grey';
                    $graph->vertices[$adjacentVertexKey]->depth = $vertex->depth + 1;
                    $graph->vertices[$adjacentVertexKey]->parent = $vertex;
                    $queue->enqueue($graph->vertices[$adjacentVertexKey]);
                }
            }
        }

        $vertex->color = 'black';
    }
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
GraphHelper::prepareGraphForBreadthFirstSearch($graph);
breadthFirstSearch($graph, $graph->vertices['s']);

foreach ($graph->vertices as $vertex) {
    $shortestPath = [];
    /** @var Vertex $vertex */
    $parent = $vertex;


    while ($parent) {
        $shortestPath[] = $parent->key;
        $parent = $parent->parent;
    }

    $pathString = implode('->', array_reverse($shortestPath));

    printf('An optimal path to vertex %s from %s is %s.', $vertex->key, 's', $pathString);
    print PHP_EOL;
}