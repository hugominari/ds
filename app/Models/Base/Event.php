<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Event
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $date
 * @property string $local
 * @property int $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereLocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Eloquent
{
	protected $casts = [
		'type' => 'int'
	];

	protected $dates = [
		'date'
	];

	public function addresses()
	{
		return $this->hasMany(\App\Models\Address::class);
	}
}
