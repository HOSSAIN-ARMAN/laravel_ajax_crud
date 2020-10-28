<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use View;
use DB;
use Illuminate\Support\Facades\Input;


class PostController extends Controller
{

    public $message;

    public function __construct () {
        view::share([
            'posts' => Post::paginate(20),
        ]);
    }
    public function index () {
        return view('index');
    }
    public function store(Request $request) {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
        ]);

        $data = Post::updateOrCreate(['id' => $request->id], [
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json(['code'=>200, 'message'=> 'ok', 'data' =>$data ], 200);

    }

    public function show () {
        $l = 2;
        return response()->json(['data' => Post::all()->take($l)]);
    }
    public function edit($id=null) {

        $post = Post::find($id);
        return response()->json($post);
    }

    public function distroy(Request $request) {
      $post = Post::find($request->id)->delete();
      return response()->json(['code' => 200, 'message' => 'Delete successfully', 'data' => $post]);
    }
    public function display($total) {
        return response()->json(['data' => Post::all()->take($total)]);
    }
    public function search (Request $request) {

        $searchData = $request->get('search_data');

        return view('index', [
           'posts' => Post::where('title','like', '%'.$searchData.'%')->orWhere('description','like', '%'.$searchData.'%')->paginate(20)
        ]);

    }
    public function showByLaravel ($i) {
        if ($i){
            return view('index', [
                'posts' => Post::paginate($i)
            ]);
        }
    }
}
