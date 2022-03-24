<?php

namespace App\Http\Controllers;

use App\Models\locations;
use Illuminate\Http\Request;

class locationController extends Controller
{
    public function store(Request $request)
    {
        $data= new locations();
        
        $data->title = $request->title;
        $data->description = $request->description;


        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }
        $data->save();
        return redirect('/')->with('status', 'Location Added Successfully..!');
    }

    public function search(Request $request)
    {
        $search_text = $_GET["query"];
        $locations = locations::where("title" , "LIKE" , "%".$search_text."%")->get();
        return view('welcome' , compact("locations"));
    }
}
