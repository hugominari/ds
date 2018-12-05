<?php

namespace App\Models;

/**
 * App\Models\Poll
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $date_start
 * @property \Illuminate\Support\Carbon|null $date_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PollHasOption[] $poll_has_options
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Poll whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Poll extends \App\Models\Base\Poll
{
	protected $fillable = [
		'title',
		'date_start',
		'date_end'
	];
}
