<?php

namespace App\Http\Controllers\API;

use App\Helicopter;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

class HelicopterController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helicopters = Helicopter::all();
        return $this->sendResponse($helicopters->toArray(), 'Products retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required',
            'speed' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $helicopter = Helicopter::create($input);
        return $this->sendResponse($helicopter->toArray(), 'Helicopter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $helicopter = Helicopter::find($id);
        if (is_null($helicopter)) {
            return $this->sendError('Helicopter not found.');
        }

        return $this->sendResponse($helicopter->toArray(), 'Helicopter retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function edit(Helicopter $helicopter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Helicopter $helicopter)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required',
            'speed' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $helicopter->type = $input['type'];
        $helicopter->name = $input['name'];
        $helicopter->speed = $input['speed'];
        $helicopter->detail = $input['detail'];
        $helicopter->color = $input['color'];
        $helicopter->save();
        return $this->sendResponse($helicopter->toArray(), 'Helicopter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helicopter $helicopter)
    {
        $helicopter->delete();
        return $this->sendResponse($helicopter->toArray(), 'Helicopter deleted successfully.');
    }

    public function test(){

    $client = new \GuzzleHttp\Client();

    $request = $client->get('https://jsonplaceholder.typicode.com/users');

    $response = $request->getBody();

echo $response;
}

public function getUsersKey(){

    $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/user', [
            'auth' => ['th4n4tos88', 'ofi-0281-2011']
        ]);
        // echo $res->getStatusCode();
        // "200"
        // echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        $stream = $res->getBody();
        $contents = $stream->getContents();
        $validate=(json_decode($contents , true));
        
        echo gettype($res);
        echo $res->getBody();

// {"type":"User"...'

// Send an asynchronous request.
// $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
// $promise = $client->sendAsync($request)->then(function ($response) {
//     echo 'I completed! ' . $response->getBody();
// });
// $promise->wait();
}

}
