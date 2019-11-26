<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('id','DESC')->paginate();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags       = Tag::orderBy('name','ASC')->get();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        // Validar
        $data = $request->all();

        if($request->hasFile('file')) {
            $data['file'] = $request->file->store('');
            $data['file'] = asset('/img/'.$data['file']);
        }

        $post = Post::create($data);
        $post->tags()->attach($data['tags']);

        return redirect()->route('posts.edit', $post->id)
                ->with('info','Entrada creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('pass',$post);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('pass',$post);
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags       = Tag::orderBy('name','ASC')->get();
        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('pass',$post);
        // Validar
        $post->fill($request->except('file'));

        if($request->hasFile('file')) {
            $ruta = str_replace(asset('/img/'),'',$post->file);
            Storage::delete([$ruta]);
            $data = $request->file->store('');
            $post->file = asset('/img/'.$data);
        }

        $post->tags()->sync($request->tags);

        $post->save();
        // dd($post);

        return redirect()->route('posts.edit',$post->id)
                ->with('info','Entrada actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('pass',$post);
        $ruta = str_replace('https://blog.test/img/','',$post->file);
        Storage::delete([$ruta]);
        $post->delete();
        return back()->with('info',"Se eliminó la Entrada: {$post->name}");
    }
}
