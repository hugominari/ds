<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Poll
 *
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property \Illuminate\Database\Eloquent\Collection $poll_has_options
 * @package App\Models\Base
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Poll onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Poll whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Poll withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Poll withoutTrashed()
 * @mixin \Eloquent
 */
class Poll extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $dates = [
		'date_start',
		'date_end'
	];

	public function poll_has_options()
	{
		return $this->hasMany(\App\Models\PollHasOption::class);
	}
}
