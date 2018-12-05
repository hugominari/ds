<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PollOption
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Database\Eloquent\Collection $poll_has_options
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PollOption whereSlug($value)
 * @mixin \Eloquent
 */
class PollOption extends Eloquent
{
	public $timestamps = false;

	public function poll_has_options()
	{
		return $this->hasMany(\App\Models\PollHasOption::class);
	}
}
