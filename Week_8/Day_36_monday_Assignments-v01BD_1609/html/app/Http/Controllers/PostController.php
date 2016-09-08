<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;

use Blog\Http\Requests;
use Blog\User;
use Blog\Post;
use Auth;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //validate
        $this->validate($request, array(
                'title' => 'required|max:200',
                'text' => 'required'
            ));
        //saved to db
        $post = new Post;

        $post->title = $request->title;
        $post->text = $request->text;
        $post->author_id = Auth::user()->id ;
        $post->created_at = date("Y-m-d h:i:s");
        $post->save();

        //redirect to post details page using route name
        return $this->show($post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get post row  from db
        $post = Post::find($id);
        if($post) {
            //find() find items by primary key
            $author_name = User::find($post->author_id)->name;
            $data = ['author_name' => '', 'created_at' => $post->created_at , 'title' => $post->title, 'text' => $post->text];

            return view('post')->with('data', $data);   
        } else {
            return redirect('posts');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
