<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
class PostController extends Controller
{
  /**
   * Saves a new post to the database
  */

  public function savePost(Request $request) {

    if($request->isMethod('GET')){
        return view('publish');
    }

    $data = $request->only(['title', 'body']);
    $post = Post::create($data);

    event(new \App\Events\PostCreated($post));
    return redirect()->action('PostController@getPosts');

}

   /**
   * Fetches all Post in the database
   */
   public function getPosts() {

    $posts = Post::all();
    return view('welcome', compact($posts));

}
}
