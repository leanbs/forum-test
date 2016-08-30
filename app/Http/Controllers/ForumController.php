<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Post;
use App\Reply;
use App\Http\Requests\CreateReplyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ForumController extends Controller
{
    /**
     * Validation rule for post creation.
     *
     * @var array
     */
    protected $rules = [
        'title'   => 'required|max:30',
        'category' => 'required',
        'body'   => 'required|min:10',
    ];

	public function __construct()
    {
        $this->middleware('auth', ['except' => ['viewPost']]);
    }

	/**
	* Display a listing of the resource
	*
	* @return \Illuminate\Http\Response
	*/
    public function getPost()
    {

    	$categories = Category::all();

    	return view('pages.question', compact('categories'));
    }

    public function postQuestion(Request $request)
    {
        $this->validate($request, $this->rules);
	
	//handle script and php tags
        $body = $request['body'];
        $doc = new \DOMDocument();
        $doc->loadHTML($body);
        $script_tags = $doc->getElementsByTagName('script');
        $length = $script_tags->length;
        for ($i = 0; $i < $length; $i++) {
          $script_tags->item($i)->parentNode->removeChild($script_tags->item($i));
        }
        $body = $doc->saveHTML();
        $body = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $body);

    	$post = new Post();

        $post->user_id = Auth::user()->id;
    	$post->category_id = $request['category'];
        $post->title = $request['title'];
        $post->body = $body;

        $post->save();

        return redirect('/');
    }

    public function viewPost($slug)
    {
        try{

            $post = Post::where('slug', '=', $slug)->first();

            return view('pages.reply', compact('post'));
        }
        catch(ModelNotFoundException $ex)
        {
            return redirect('/');
        }
        
    }

    public function saveReply(Request $request)
    {
        $post = Post::where('slug', '=', $request['slug'])->first();
        
        if($post)
        {
            $reply = new Reply;

            $reply->post_id = $post->id;
            $reply->user_id = Auth::user()->id;
            $reply->body = $request['body'];

            $reply->save();

            return redirect()->back();
        }

        return redirect('/');
    }

    public function deleteQuestion(Request $request)
    {
        try{

            $post = Post::findOrFail($request['post_id']);

            if(Auth::User()->id == $post->user_id)
            {
                $post->delete();
            }

            return redirect()->back();
        }
        catch(ModelNotFoundException $ex)
        {
            return redirect('/');
        }
    }

    public function deleteReply(Request $request)
    {
        try{

            $reply = Reply::findOrFail($request['post_id']);

            if(Auth::User()->id == $reply->user_id)
            {
                $reply->delete();
            }

            return redirect()->back();
        }
        catch(ModelNotFoundException $ex)
        {
            return redirect('/');
        }
    }
}
