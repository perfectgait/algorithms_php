<?php

namespace Algorithm\Helper;

use Algorithm\Graph\Graph;
use Algorithm\Graph\Vertex;

/**
 * Class GraphHelper
 * @package Algorithm\Helper
 */
class GraphHelper
{
    /**
     * @param Graph $graph
     */
    public static function prepareGraphForBreadthFirstSearch(Graph &$graph)
    {
        foreach ($graph->vertices as $vertex) {
            /** @var Vertex $vertex */
            $vertex->color = 'white';
            $vertex->parent = null;
            $vertex->depth = -1;
        }
    }

    /**
     * @param Graph $graph
     */
    public static function prepareGraphForDepthFirstSearch(Graph &$graph)
    {
        foreach ($graph->vertices as $vertex) {
            /** @var Vertex $vertex */
            $vertex->color = 'white';
            $vertex->parent = null;
            $vertex->start = 0;
            $vertex->finish = 0;
        }
    }

    /**
     * @param Graph $graph
     * @param Vertex $source
     */
    public static function initializeSingleSource(Graph $graph, Vertex $source)
    {
        foreach ($graph->vertices as $vertex) {
            /** @var Vertex $vertex */
//            $vertex->shortestPathEstimate = null;
            $vertex->shortestPathEstimate = PHP_INT_MAX;
            $vertex->parent = null;
        }

//        $graph->vertices[$source->key]->shortestPathEstimate = 0;
        $source->shortestPathEstimate = 0;
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
    public static function relax(Vertex $source, Vertex $destination, callable $weightFunction)
    {
        if (!is_null($source->shortestPathEstimate)
            && (is_null($destination->shortestPathEstimate)
                || $destination->shortestPathEstimate > $source->shortestPathEstimate + $weightFunction($source, $destination))
        ) {
            $destination->shortestPathEstimate = $source->shortestPathEstimate + $weightFunction($source, $destination);
            $destination->parent = $source;
        }
    }
}