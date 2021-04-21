<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
      return view("rss");
    }

    
    public function rss(Request $request){
        $news = [];
          $urlrss = file_get_contents('https://www.antaranews.com/rss/terkini.xml');
          $xmlObject = simplexml_load_string($urlrss);
          $json = json_encode($xmlObject);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sauce' => 'antara',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }else{
              array_push($news, [
                'sauce' => 'antara',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }

          $urlrss = file_get_contents('https://www.sindonews.com/feed');
          $xmlObject = simplexml_load_string($urlrss);
          $json = json_encode($xmlObject);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sauce' => 'sindo',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }else{
              array_push($news, [
                'sauce' => 'sindo',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }
          $urlrss = file_get_contents('http://tribunnews.com/rss');
          $xmlObject = simplexml_load_string($urlrss);
          $json = json_encode($xmlObject);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sauce' => 'tribun',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }else{
              array_push($news, [
                'sauce' => 'tribun',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }

          $urlrss = file_get_contents('http://www.hmetro.com.my/utama.xml');
          $xmlObject = simplexml_load_string($urlrss);
          $json = json_encode($xmlObject);
          $array = json_decode($json);

          foreach ($array->channel->item as $value) {
            if ($request->has('search') && $request->search != '') {
              if (strpos($value->title, $request->search)!==false) {
                array_push($news, [
                  'sauce' => 'metro',
                  'title' => $value->title,
                  'link' => $value->link
                ]);
              }
            }else{
              array_push($news, [
                'sauce' => 'metro',
                'title' => $value->title,
                'link' => $value->link
              ]);
            }
          }

        return response()->json(compact('news'));
    }
}
