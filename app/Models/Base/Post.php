<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Post
 *
 * @property int $id
 * @property int $type
 * @property string $title
 * @property string $description
 * @property string $source
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Base
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'type' => 'int'
	];
}
