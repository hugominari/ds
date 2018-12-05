<?php

namespace App\Models;

/**
 * App\Models\Feed
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feed whereUrl($value)
 * @mixin \Eloquent
 */
class Feed extends \App\Models\Base\Feed
{
	protected $fillable = [
		'name',
		'url'
	];
    
    /**
     * @param $feed_url
     *
     * @return string
     */
    public function getFeed()
    {
        try
        {
            if(!empty($this->url))
            {
                $xml = simplexml_load_file($this->url);
                $entries = $xml->xpath("//item");
    
                $result = "<ul class='list-unstyled'>";
    
                foreach($entries as $qtd => $entry)
                {
                    $time = strftime('%d/%m/%Y %H:%M', strtotime($entry->pubDate));
        
                    $result .= "
                    <li>
                        <a class='nav-link text-dark' href='{$entry->link}' target='_blank'>
                            <small class='font-12'>{$time}</small> - {$entry->title}
                        </a>
                    </li>";
        
                    if($qtd > 2)
                        break;
                }
    
                $result .= "</ul>";
    
                return $result;
            }
        }
        catch(\Error $ex)
        {
            \Log::debug($ex);
        }
        
        return null;
    }
}
