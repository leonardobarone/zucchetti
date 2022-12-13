<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class PostController extends Controller
{
    protected $validationRules = [
        "title" => "required|string|max:100",
        "content" => "required|string",
        "category_id" => "nullable|exists:categories,id"
    ];
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        
        $newPost = new Post();
        $newPost->fill($request->all());

        $newPost->slug = $this->getSlug($request->title);
        $newPost->save();

        return redirect()->route('admin.posts.index')->with('success','Hai inserito un nuovo post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationRules);
        
        if ($request->title == $post->title && $request->category_id == $post->category_id && $request->content == $post->content) {
            return redirect()->route('admin.posts.edit', $post->id);
        }

        if ($post->title != $request->title) {
            $post->slug = $this->getSlug($request->title);
        }

        $post->fill($request->all());
        $post->save();
        
        return redirect()->route('admin.posts.index')->with('success', 'Hai modificato il post!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Hai eliminato il post!');
    }
    
    /**
     * getSlug return unique slug with slugWithCount
     *
     * @param  string $title
     * @return string
     */
    private function getSlug($title) 
    {
        $slug = Str::of($title)->slug('_');
        $postExist = Post::where('slug', $slug)->first();

        // slug++
        $count = 2;
        while ($postExist) {
            $slug = Str::of($title)->slug('_') . '_' . $count;
            $postExist = Post::where('slug', $slug)->first();
            $count++;
        }

        return $slug;
    }
}
