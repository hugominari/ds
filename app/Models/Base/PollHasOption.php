<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PollHasOption
 *
 * @property int $id
 * @property int $poll_id
 * @property int $poll_option_id
 * @property int $votes
 * @property \App\Models\PollOption $poll_option
 * @property \App\Models\Poll $poll
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption wherePollId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption wherePollOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollHasOption whereVotes($value)
 * @mixin \Eloquent
 */
class PollHasOption extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'poll_id' => 'int',
		'poll_option_id' => 'int',
		'votes' => 'int'
	];

	public function poll_option()
	{
		return $this->belongsTo(\App\Models\PollOption::class);
	}

	public function poll()
	{
		return $this->belongsTo(\App\Models\Poll::class);
	}
}
