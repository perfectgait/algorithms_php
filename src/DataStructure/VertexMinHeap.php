<?php

namespace Algorithm\DataStructure;

use Algorithm\Graph\Vertex;

/**
 * Class VertexMinHeap
 * @package Algorithm\DataStructure
 */
class VertexMinHeap extends \SplMinHeap
{
    /**
     * @param Vertex $vertex1
     * @param Vertex $vertex2
     * @return int
     */
    protected function compare($vertex1, $vertex2)
    {
        if ($vertex1->shortestPathEstimate > $vertex2->shortestPathEstimate) {
            return -1;
        } elseif ($vertex1->shortestPathEstimate === $vertex2->shortestPathEstimate) {
            return 0;
        }

        return 1;
    }
}