<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Feed
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Feed query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Feed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Feed whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Feed whereUrl($value)
 * @mixin \Eloquent
 */
class Feed extends Eloquent
{
	public $timestamps = false;
}
