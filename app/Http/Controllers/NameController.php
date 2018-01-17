<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Name;

class NameController extends Controller
{
    //
    public function index()
    {
    	$names=Name::all();
    	return view('names.index',compact('names'));
    }

    public function show(Name $id)
    {
    	//$names=Name::find($id);
    	return view('names.show',compact('id'));
    }
}
