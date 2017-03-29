<?php

namespace App\Transformers;

/**
 * Class ClientTransformer
 *
 * Filter all out-going data
 */
class ClientTransformer implements TransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function transformCollection($items, $type = '')
    {
        $data = [];

        // iterate all records
        foreach ($items as $item) {
            $data[$item->name[0]][] = $this->transform($item);
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function transform($item)
    {
        return [
            'name'     => $item->name,
            'url'      => $item->url,
            'logo'     => $item->logo,
            'address'   => $item->street . ' ' . $item->suburb . ' ' . $item->city . ' ' . $item->postcode . ' ' . $item->country,
        ];
    }
}