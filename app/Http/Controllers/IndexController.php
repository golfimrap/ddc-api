<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function login()
    {
        // dd(env('USERNAME_API'), env('PASSWORD_API'));
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://ddc-api.local/api/login', [
            'form_params' => [
                'email'      => env('USERNAME_API'),
                'password'   => env('PASSWORD_API'),
            ],
            'verify' => false,
            'connect_timeout' => 30
        ]);

        // dd($response);

        $data = json_decode($response->getBody(), true);
        // dd($data['access_token']);
        return $data['access_token'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = $this->login();
        // dd($token);
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $response = $client->request('GET','http://ddc-api.local/api/users',[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
        ]);
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

        //dd($request->all());
        $token = $this->login();
         //dd($token);
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $response = $client->request('POST','http://ddc-api.local/api/users', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                //'Content-Type' => 'application/json'
            ],
            'form_params' => [
                'name'      => 'dsadsdasdsa',
                'email'     => 'dsdsdsd@dsdfd.com',
                'password'  => '12345454'
            ]
        ]);
        // dd($response);
        $data_users = json_decode($response->getBody(), true);
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
        $token = $this->login();
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $response = $client->request('GET', 'http://ddc-api.local/api/users/'.$id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
        ]);
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
        $token = $this->login();
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $client->request('PATCH', 'http://ddc-api.local/api/users/'.$id , [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ],
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
        $token = $this->login();
        $client = new \GuzzleHttp\Client([ 'verify' => false ]);
        $client->request('DELETE', 'http://ddc-api.local/api/users/'.$id,[
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ],
        ]);

        return redirect()->route('user.index');
    }
}
