<?php

namespace App\Http\Controllers;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class FirebaseController extends Controller
{
    public function fetchData(){

        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/laravel-firebase-969f3-firebase-adminsdk-zwm1g-87fff7a4a5.json')
            ->withDatabaseUri('https://laravel-firebase-969f3-default-rtdb.firebaseio.com/');

        $database = $firebase->createDatabase();

        $blog = $database
        ->getReference('blog');
        echo '<pre>';
        print_r($blog->getvalue());
        echo '</pre>';
    }
    public function index(){
        return view ('index');
    }
    public function store(Request $request){
        // $config = [
        //     'keyFilePath' => __DIR__ . '/fir-66600-firebase-adminsdk-iejdq-0f0ccee00b.json',
        //     'projectId' => 'fir-66600',
        // ];
        // $storage = new StorageClient($config);
        // $bucket = $storage->bucket('fir-66600');
        // if ($request->image) {
        //     $img=$request->image;
        //     $filenamewithextension = $img->getClientOriginalName();
        //     $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $filenametostore = $filename . '_' . uniqid() . '.' . $extension;
        //     Storage::put('public/uploads/' . $filenametostore, fopen($img, 'r+'));
        //     $filepath = storage_path('app/public/uploads/' . $filenametostore);
        //     $myfile = fopen(storage_path() . '/app/public/uploads/' . $filenametostore, 'r');
        //     $bucket->upload($myfile, [
        //         'name' => "images/" . $filenametostore
        //     ]);
        //     Storage::delete('public/uploads/' . $filenametostore);
        // } else {
        //     $filenametostore = '';
        // }
        // return redirect()->back();

        $image = $request->image;
        $data   = app('firebase.firestore')->database()->collection('images')->document('defT5uT7SDu9K5RFtIdl');
        $firebase_storage_path = 'images/';
        $name     = $data->id();
        $localfolder = public_path('firebase-temp-uploads') .'/';
        $extension = $image->getClientOriginalExtension();
        $file      = $name. '.' . $extension;
        if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);
            // unlink($localfolder . $file);
            echo 'success';
        } else {
            echo 'error';
        }


    }
}
