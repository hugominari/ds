<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Website
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $type
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Website whereUrl($value)
 * @mixin \Eloquent
 */
class Website extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'type' => 'int'
	];
}
