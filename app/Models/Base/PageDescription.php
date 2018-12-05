<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PageDescription
 *
 * @property int $id
 * @property string $text
 * @property int $sector
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription whereSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PageDescription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PageDescription extends Eloquent
{
	protected $casts = [
		'sector' => 'int'
	];
}
