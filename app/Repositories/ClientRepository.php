<?php

namespace App\Repositories;

use App\Models\Clients;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientRepository
 *
 * This performs all enum data requests
 */
class ClientRepository
{
    /**
     * Constructor
     *
     * Initialize all needed classes
     *
     * @param Clients $client
     */
    public function __construct(Clients $client)
    {
        $this->client = $client;
    }

    /**
     * Create a single record
     *
     * @param array $userInput
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create($userInput)
    {
        return $this->client->create([
            'name'     => $userInput['name'],
            'url'      => $userInput['url'],
            'logo'     => $userInput['logo'],
            'street'   => $userInput['street'],
            'city'     => $userInput['city'],
            'suburb'   => $userInput['suburb'],
            'postcode' => $userInput['postcode'],
            'country'  => $userInput['country'],
        ]);
    }

    /**
     * Get client record/s, based on user search input
     *
     * @param array $search
     * @return object $languages
     */
    public function search($search = [])
    {
        $client = $this->client;

        if (array_key_exists('search_name', $search) && ! empty($search['search_name'])) {
            $client = $client->where('name', 'LIKE', '%' . $search['search_name'] . '%');
        }

        if (array_key_exists('search_address', $search) && ! empty($search['search_address'])) {
            $client = $client->where(function ($query) use ($search) {
                $query->orwhere('street', 'LIKE', '%' . $search['search_address'] . '%')
                    ->orwhere('city', 'LIKE', '%' . $search['search_address'] . '%')
                    ->orwhere('suburb', 'LIKE', '%' . $search['search_address'] . '%')
                    ->orwhere('postcode', 'LIKE', '%' . $search['search_address'] . '%')
                    ->orwhere('country', 'LIKE', '%' . $search['search_address'] . '%')
                    ->orwhere(DB::raw("concat_ws(' ',street,suburb,city,postcode,country)"), 'LIKE', '%' . $search['search_address'] . '%');
            });
        }

        $client = $client->orderBy('name', 'ASC');

        return $client;
    }
}
