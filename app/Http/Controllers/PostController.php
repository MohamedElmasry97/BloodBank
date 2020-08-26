<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $records = Post::where('category_id', $category_id)->get();
        return view('post.index', compact( 'records' , 'category_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id)
    {
        return view('post.create', compact('category_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $category_id , Request $request)
    {
        $this->validate($request , [
            'title' => 'required',
            'data' => 'required',
           // 'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',

            $category_id => 'exsits:categories,id'
        ]);
        Post::create($request->all() + ['category_id' => $category_id]);
        return redirect()->route('category.post.index' , $category_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $category_id , $id)
    {
        $model = Post::FindOrFail($id);
        return view('post.edit', compact( 'model' , 'category_id '));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id , $id)
    {

        // $rules = [
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ];
        // $this->validate($request , $rules);

        Post::FindOrFail($id)->update($request->all());

        return redirect()->route('category.post.index' , compact('category_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id , $id)
    {
        Post::FindOrFail($id)->delete();
        return redirect()->route('category.post.index' , compact('category_id'));
    }
}
