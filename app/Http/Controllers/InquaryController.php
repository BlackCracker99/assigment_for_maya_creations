<?php

namespace App\Http\Controllers;

use App\Models\Inquary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class InquaryController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make(
            array(
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
            ),
            array(
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required',
            )
        );


        if ($validator->fails()) {
            // $messages = $validator->messages();
            return redirect('/')->with('status_failed', 'Inquary Send Failed...! Please Enter Correct Data..!');
        } else {
            $inquary = new Inquary;
            $inquary->name = $request->name;
            $inquary->email = $request->email;
            $inquary->location = $request->location;
            $inquary->mobile = $request->mobile;
            $inquary->save();
            return redirect('/')->with('status', 'Inquary Send.. We will contact you soon..!');
        }
    }
}
