<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Zayavka;

class ZayavkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $this->validate($request,[
            'type' => 'required',
            'name' => 'required|max:30',
            'phone' => 'required|max:20',
            'description' => 'required',
        ]);

        // otpravit zayavku na text file
        if($request['type'] == 1){

            $data = [];
            
            $data['name'] = " name: ".$request['name'];
            $data['phone'] = " phone: ".$request['phone'];
            $data['description'] = " description: ".$request['description'].PHP_EOL;

            $file = base_path('/storage/zayavka.txt');

            if (!file_exists($file)) {
                mkdir(dirname($file), 0777, true);
            }

            if(file_put_contents($file, $data, FILE_APPEND | LOCK_EX))
            return response()->json(['status' => 'success']);

        } 

        // otpravit zayavku na mysql bazu
        if($request['type'] == 2){
            if(Zayavka::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'description' => $request['description'],
            ])){
                    return response()->json(['status' => 'success']); 
                }

        } 

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
