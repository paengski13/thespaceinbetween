<?php

namespace App\Http\Controllers;

use App\Helpers\ConstantHelper;
use App\Repositories\ClientRepository;
use App\Transformers\ClientTransformer;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param ClientRepository $client
     * @param ClientTransformer $transformer
     */
    public function __construct(ClientRepository $client, ClientTransformer $transformer)
    {
        $this->client      = $client;
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userInput = $request->all();

        // get all clients based on the search filter
        $clients   = $this->client->search($userInput)->get();

        // convert it into a formatted array
        $data['clients']    = $this->transformer->transformCollection($clients);
        $data['input']        = $userInput;

        // return composed data
        return response()->view('search', [
            'data' => $data
        ]);
    }

    /**
     * Manage Post Request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        // validate if file exist and check if it is a CSV file.
        if (! $request->hasFile('upload')) {
            return back()
                ->with('error', 'No file uploaded');
        } elseif ($request->upload->getClientOriginalExtension() != 'csv') {
            return back()
                ->with('error', 'Invalid extension, please upload a csv file');
        }

        $file = fopen($request->file('upload'), 'r');
        // read each record in the csv file
        while(! feof($file))
        {
            $arr = fgetcsv($file);

            // the number of columns should be exact or else skip the record
            if (count($arr) == ConstantHelper::CSV_COLUMN) {
                // save the record
                $this->client->create([
                    'name'      => $arr[0],
                    'url'       => $arr[1],
                    'logo'      => $arr[2],
                    'street'    => $arr[3],
                    'city'      => $arr[4],
                    'suburb'    => $arr[5],
                    'postcode'  => $arr[6],
                    'country'   => $arr[7],
                ]);
            }
        }
        fclose($file);

        return back()
        ->with('success','Uploaded successfully.');
    }
}
