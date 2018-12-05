<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * App\Models\Mandatory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $date_start
 * @property \Illuminate\Support\Carbon $date_end
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $members
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereName($value)
 * @mixin \Eloquent
 */
class Mandatory extends \App\Models\Base\Mandatory
{
	protected $fillable = [
		'name',
		'date_start',
		'date_end'
	];
    
    public function setDateStartAttribute($value)
    {
        if(!empty($value))
            $this->attributes['date_start'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    
    public function setDateEndAttribute($value)
    {
        if(!empty($value))
            $this->attributes['date_end'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
