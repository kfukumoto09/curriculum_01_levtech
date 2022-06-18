<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
//use Post;
use Illuminate\Http\Request;

use Illuminate\Validation\Validator;


class PostController extends Controller
{
    /**
     * Post一覧を表示する
     * 
     * @param Post Postモデル
     * @return array Postモデルリスト
     */
    public function index() {
        // return $post->get();
        $post = new Post;
        //$test = $post->getByLimit();
        //dd($test);
        //return view('posts/index');
        //$test = $post->getByLimit();
        //dd($test);
        //return view('posts/index')->with(['posts' => $post->getByLimit()]);
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    /**
     * 1個のPostページを表示する
     * 
     * @param Post Postモデル
     * @return array Post
     */
    public function show(Post $post) {
        return view('posts/show')->with(['post' => $post]);
    }
    
    public function create(){
        return view('posts/create');
    }
    
    /*
    public function show($id, Post $post) {
        return view('posts/show')->with(['post' => $post->showPost()[$id]]);
    }
    */
    
    public function store(PostRequest $request, Post $post) 
    {
        /*
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:40',
            'body' => 'required|max:4000',
        ]);
        
        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator, 'posting')
                        ->withInput();
        }
        */
        
        $input = $request['post'];
        $post->fill($input)->save(); //->toSql();
        // $post->fill($input)->toSql(); //->save()->toSql;
        //var_dump($test);
        //dd($post->toSql());
        
        //$validated = $request->validated();
        //$post->fill($validated)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }

    
}

?>