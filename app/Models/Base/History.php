<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class History
 *
 * @property int $id
 * @property int $user_id
 * @property int $record_id
 * @property string $title
 * @property string $description
 * @property int $type
 * @property int $action
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\User $user
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\History whereUserId($value)
 * @mixin \Eloquent
 */
class History extends Eloquent
{
	protected $table = 'history';

	protected $casts = [
		'user_id' => 'int',
		'record_id' => 'int',
		'type' => 'int',
		'action' => 'int'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
