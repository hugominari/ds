<?php

namespace App\Models;

/**
 * App\Models\Social
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereUrl($value)
 * @mixin \Eloquent
 */
class Social extends \App\Models\Base\Social
{
	protected $fillable = [
		'name',
		'icon',
		'url'
	];
}
