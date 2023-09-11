<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class BaseController extends Controller
{

    /**
     * @return \illuminate\Http\Response
     *
     */
   public function UploadXML ()
   {

    return view('welcome');

   }


   /**
    * Upload XML files to Folder "xml-tx\" where it will be processed.
    *
    * @return \illuminate\Http\response
    *
    */

    public function UploadXMLpost (Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xml|max:15048',
        ]);

        $fileName = $request->file->getClientOriginalName();

        $request->file->move(public_path('xml-tx'), $fileName);

        return back()
        ->with('success', 'You have successfully upload file.')
        ->with('file', $fileName);

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $xmlfolder = ".\public\xml-tx";
        $files = Storage::files($xmlfolder);


        $fileslist = json_encode($files);
        return $filesArray = json_decode($fileslist , true);

    }



    public function show(Request $request)
    {
        $xmlfolder = "public";
        $files = Storage::files($xmlfolder);

        // $fileslist = json_encode($files);
        // $filesArray = json_decode($fileslist , true);

        return response()->json($files);

    }







}
