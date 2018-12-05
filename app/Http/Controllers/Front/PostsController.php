<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryPosts = Post::query()
            ->orderByDesc('created_at')
            ->take(2);
        
        $pinPosts = $queryPosts->get();
        
        $ids = $queryPosts->select('id')
            ->get()
            ->makeHidden(['image', 'type_text', 'tag', 'resume'])
            ->toArray();
        
        $lastPosts = Post::query()
            ->when(!empty($ids), function($query) use($ids){
                return $query->whereNotIn('id', $ids);
            })
            ->orderByDesc('created_at')
            ->paginate(6);
        
        $data = [
            'pinPosts',
            'lastPosts',
        ];

        return view('front.posts.index', compact($data));
    }
	
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
	    $post = Post::findOrFail($id);
		return view('front.posts.show', compact(['post']));
	}
}
