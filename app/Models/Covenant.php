<?php

namespace App\Models;

use App\Http\Controllers\DefaultController;

/**
 * App\Models\Covenant
 *
 * @property int $id
 * @property string $name
 * @property string|null $url
 * @property string|null $description
 * @property-read array|object $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Covenant whereUrl($value)
 * @mixin \Eloquent
 */
class Covenant extends \App\Models\Base\Covenant
{
	protected $fillable = [
		'name',
		'url',
		'description'
	];
    
    protected $appends
        = array('image');
    
    /**
     * @return array|object
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getImageAttribute()
    {
        $controller = new DefaultController();
        return $controller->getFile("public/covenants/{$this->id}", 'image');
    }
}
