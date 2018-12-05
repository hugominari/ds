<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Covenant
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Covenant whereUrl($value)
 * @mixin \Eloquent
 */
class Covenant extends Eloquent
{
	public $timestamps = false;
}
