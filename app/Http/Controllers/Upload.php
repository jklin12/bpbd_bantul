<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Upload extends Controller
{
    public function index(Request $request)
    {
        if ($request->hasFile('file')) {

            // Upload path
            $destinationPath = 'files/';

            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg", "jpg", "png");

            $res = [];
            // Check extension
            if (in_array(strtolower($extension), $validextensions)) {

                // Rename file 
                $fileName = $request->file('file')->getClientOriginalName() . time() . '.' . $extension;
                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);
                $res = [
                    'status' => true,
                    'name' => $fileName
                ];
            }else{
                $res = [
                    'status' => false,
                ];
            }

            echo json_encode($res);
        }
    }
}
