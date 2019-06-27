<?php

namespace App\Http\Controllers;

use File;
use Illuminate\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use TheSeer\Tokenizer\XMLSerializer;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('xml');
    }

    /**
     * Show homepage.
     *
     * @return \Illuminate\View\View
     */
    public function showHomepage() : View
    {

        return view('welcome');
    }


    private function getFBFeed(){
        $client = new Client();
        $request1 = new \GuzzleHttp\Psr7\Request('GET', 'https://graph.facebook.com/winewednesdaysdbn/feed?access_token=564202827266707|a142d6093609903a733d60797255520f&fields=created_time,picture,cover_photo,name');
        $promise1 = $client->sendAsync($request1)->then(function ($response) {
            $albums = json_decode($response->getBody(), true);
            $albumsArray= collect($albums)->first();
            dd($albumsArray);
//            $allAlbums = array();
//            foreach ($albumsArray as $singleAlbum) {
//                $album = new Album();
//                $album->id = $singleAlbum["id"];
//                $album->created_time = $singleAlbum["created_time"];
//                if (!empty($singleFeed["name"])) {
//                    $album->name = $singleAlbum["name"];
//                }
//
//                if (!empty($singleAlbum["picture"])) {
//                    $picture = collect($singleAlbum["picture"])->first();
//                    $album->pictureUrl = collect($picture)["url"];
//                }
//                if ($album != null) {
//                    array_push($allAlbums, $album);
//                }
//
//            }
//
//            Session::put('allAlbums', $allAlbums);

        });
        $promise1->wait();
    }

    private function getSpacesUploads(){
        $client = new Client();
        $results = $client->request('GET', 'https://uploads-winewednesdays.ams3.digitaloceanspaces.com/48_GIN__Bernini_Wine_Wednesdays/361A0093.jpg');

//        dd($results);
    }

    public function getFolderImages($folder){
        $filesInFolder = File::files('assets/images/gallery/'.$folder);
        $filenames = [];
        foreach($filesInFolder as $path) {
            $file = pathinfo($path);
            array_push($filenames,$file['dirname'].'/'.$file['basename']) ;
        }

        return $filenames;
    }
}
