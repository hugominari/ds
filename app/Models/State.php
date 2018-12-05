<?php

namespace App\Models;

/**
 * App\Models\State
 *
 * @property int $id
 * @property string $name
 * @property string $initials
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\City[] $cities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\State query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\State whereInitials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\State whereName($value)
 * @mixin \Eloquent
 */
class State extends \App\Models\Base\State
{
	protected $fillable = [
		'name',
		'initials'
	];
}
