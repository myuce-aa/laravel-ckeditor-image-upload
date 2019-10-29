<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CkeditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ckeditor');
    }
	/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {        
        $file = $request['upload'];

        // Build the input for validation
        $fileArray = array('upload' => $file);

        // Tell the validator that this file should be an image
        $rules = array(
            'upload' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );

        $validator = Validator::make($fileArray, $rules);
        if ($validator->fails())
        {
            $response = "<script>CKEDITOR.dialog.getCurrent().hide();</script><script>alert('File format not appropriate');</script>";                   
                
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
        else
        {
            if($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;
            
                $request->file('upload')->move(public_path('images'), $fileName);
       
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('images/'.$fileName); 
                $msg = ''; 
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                   
                @header('Content-type: text/html; charset=utf-8'); 
                echo $response;
            }
        }

       
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
