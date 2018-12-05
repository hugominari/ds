<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Feed;
use App\Models\PageDescription;
use App\Models\Post;
use App\Models\Website;
use Carbon\Carbon;

class indexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SitesUteis
        $sitesUteis = Website::query()->where('type', Website::TYPE_UTILS)->get();
        $sitesEducatives = Website::query()->where('type', Website::TYPE_EDUCATIVE)->get();
        $feeds = Feed::all();
        $pinPost = Post::query()
            ->orderByDesc('created_at')
            ->first();
        
        $lastPosts = Post::query()
            ->when(!empty($pinPost), function($query) use($pinPost){
                return $query->where('id', '<>', $pinPost->id);
            })
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();
    
        $lastDate = $lastPosts->isNotEmpty() ? $lastPosts->last()->created_at : '';
    
        $others = Post::query()
            ->when(!empty($lastDate), function($query) use($lastDate){
                return $query->where('created_at', '>', $lastDate);
            })
            ->orderByDesc('created_at')
            ->limit(15)
            ->get();
        
        $data = [
            'sitesUteis',
            'sitesEducatives',
            'feeds',
            'pinPost',
            'lastPosts',
            'others',
        ];
        
        return view('front.index', compact($data));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
	public function internalRules()
	{
	    $rules = PageDescription::SECTOR_INTERNAL_RULES;
	    $file = (new Controller)->getFile("public/institutional/{$rules}", 'regimento-interno-sindireceita-df.pdf');
		return view('front.internal-rules', compact(['file']));
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function history()
	{
        $typeHistory = PageDescription::SECTOR_OUR_HISTORY;
        $txt = PageDescription::query()
            ->select(['text', 'updated_at'])
            ->where('sector', '=', $typeHistory)
            ->first();
        
        $date = !empty($txt) ? Carbon::createFromTimeStamp(strtotime($txt->updated_at)) : '';
        $content = !empty($txt) ? $txt->text : 'Não há conteudo cadastrado para esta página!';
        $lastUpdate = $date->formatLocalized('%d de %B de %Y');
	    
		return view('front.history', compact(['content', 'lastUpdate']));
	}
}
