<?php

namespace App\Models;

use App\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\Log;

/**
 * App\Models\PageDescription
 *
 * @property int $id
 * @property string $text
 * @property int $sector
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $file
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription whereSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageDescription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PageDescription extends \App\Models\Base\PageDescription
{
	protected $fillable = [
		'text',
		'sector'
	];
    
    protected $appends = array(
        'file',
    );
	
	const SECTOR_INTERNAL_RULES         =   1;
	const SECTOR_OUR_HISTORY            =   2;
    
   
    /**
     * Function to set image append
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getFileAttribute()
    {
        $default = new DefaultController();
        $typeRule = intval($this->sector);
        
        if($typeRule == self::SECTOR_INTERNAL_RULES)
            return $default->getFile("public/institutional/{$typeRule}", 'regimento-interno-sindireceita-df.pdf', true, true);
        
        return null;
    }
}
