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
}