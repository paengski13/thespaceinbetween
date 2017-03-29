<?php

namespace App\Transformers;;

/**
 * Interface TransformerInterface
 *
 * Filter all out-going data
 */
interface TransformerInterface
{
    /**
     * This is a collection of data to be transformed
     *
     * @param \Illuminate\Database\Eloquent\Collection $items
     * @param string $type
     * @return array $data
     */
    public function transformCollection($items, $type = '');

    /**
     * This is a single record of data to be transformed
     *
     * @param \Illuminate\Database\Eloquent\Collection $item
     * @return array
     */
    public function transform($item);
}