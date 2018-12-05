<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Note
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Note whereUserId($value)
 * @mixin \Eloquent
 */
class Note extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];
}
