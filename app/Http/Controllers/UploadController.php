<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
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
        
        $uploadId = array();
        if ( $files =  $request->file('file')) {
            foreach ($request->file('file') as $key => $file) {
                $name = time() . $key . $file->getClientOriginalName();
                $nameFile = $file->getClientOriginalName();
                $filename = $file->move('files', $name);
                $uploadId[] = Upload::create([
                    'file' => $name,
                    'file_name' =>$nameFile,
                    'evento_id' => $request->evento_id])->id;
            }
        }
        return response()->json($uploadId, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        if (!(empty($upload->file))) {
            if (file_exists(public_path() . '/files/' . $upload->file)) {
                unlink(public_path() . '/files/' . $upload->file);
            }
            Upload::where('id', $upload->id)->delete();
        }
        return response()->json(null, 204);
    }
}
