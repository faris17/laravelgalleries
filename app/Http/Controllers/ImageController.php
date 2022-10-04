<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\TemporaryImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(){
        $pagination = 3;
        $results = Image::orderBy('id', 'Desc')->paginate($pagination);

        return view('list_view', compact('results'));
    }

    public function store(Request $request){
        try{
            $temporaryFolder = Session::get('folder');
            $namefile = Session::get('filename');

            $temporary = TemporaryImage::where('folder', $temporaryFolder)->where('image', $namefile)->first();

            $folderPhoto = null;
            $photo = null;

            if($temporary) {
                //hapus file and folder temporary
                $path = storage_path().'/app/files/tmp/'.$temporary->folder.'/'.$temporary->image;

                if(File::exists($path)){
                    Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->image, 'public/' . $temporary->folder . '/' . $temporary->image);

                    $folderPhoto = $temporary->folder;
                    $photo = $temporary->image;

                    //delete tmp
                    File::delete($path);
                    rmdir(storage_path('app/files/tmp/' . $temporary->folder));

                    //delete record in table temporary
                    $temporary->delete();

                }
            }

            Image::create([
                'description' => $request->description,
                'folder' => $folderPhoto,
                'image'=> $photo
            ]);

            return response()->json(['status' => true, 'message' => 'Save Successfully']);

        } catch(Exception $e){
            return response()->json(['status'=>false, 'message'=> $e->getMessage()]);
        }
    }

    public function destroy($id){
        //find data
        //delete folder dan image
        //delete data in table image
        $image = Image::find($id);

        if($image){
            //next, delete file in files folder
            $pathFile = storage_path() . '/app/public/' . $image->folder . '/' . $image->image;

            if (File::exists($pathFile)) {
                File::delete($pathFile); //delete file
                rmdir(storage_path('app/public/' . $image->folder)); //delete folder
            }
            //delete record
            $image->delete();

            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
