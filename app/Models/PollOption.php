<?php

namespace App\Models;

/**
 * App\Models\PollOption
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PollHasOption[] $poll_has_options
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollOption whereSlug($value)
 * @mixin \Eloquent
 */
class PollOption extends \App\Models\Base\PollOption
{
	protected $fillable = [
		'name',
		'slug'
	];
}
