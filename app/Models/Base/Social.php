<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Social
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $url
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Social whereUrl($value)
 * @mixin \Eloquent
 */
class Social extends Eloquent
{
	public $timestamps = false;
}
