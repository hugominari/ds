<?php

namespace App\Models;

/**
 * App\Models\PollHasOption
 *
 * @property int $id
 * @property int $poll_id
 * @property int $poll_option_id
 * @property int|null $votes
 * @property-read \App\Models\Poll $poll
 * @property-read \App\Models\PollOption $poll_option
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption wherePollId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption wherePollOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PollHasOption whereVotes($value)
 * @mixin \Eloquent
 */
class PollHasOption extends \App\Models\Base\PollHasOption
{
	protected $fillable = [
		'poll_id',
		'poll_option_id',
		'votes'
	];
}
