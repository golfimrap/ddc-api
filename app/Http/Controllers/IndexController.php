<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $response = $client->request('GET','http://ddc-api.local/api/users');
        $data_users = json_decode($response->getBody(), true);
        // $data_users = User::all();

        return view('index', [
            'data_users' => $data_users['users']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $client->request('POST','http://ddc-api.local/api/users', [
            'form_params' => [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ],
            'verify' => false,
            'connect_timeout' => 30
        ]);
        // $data_users = json_decode($response->getBody(), true);
        // $data_users = User::all();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $response = $client->request('GET', 'http://ddc-api.local/api/users/'.$id);
        $data_users = json_decode($response->getBody(), true);

        return view('edit', [
            'data_users' => $data_users['apiUsers']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $client->request('PATCH', 'http://ddc-api.local/api/users/'.$id , [
            'form_params' => [
                'id'   => $id,
                'name' => $request->name
            ],
            'verify' => false,
            'connect_timeout' => 30
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $client->request('DELETE', 'http://ddc-api.local/api/users/'.$id);

        return redirect()->route('user.index');
    }
}
