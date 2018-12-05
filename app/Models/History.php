<?php

namespace App\Models;

/**
 * App\Models\History
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $record_id
 * @property string $title
 * @property string|null $description
 * @property int $type
 * @property int|null $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\History whereUserId($value)
 * @mixin \Eloquent
 */
class History extends \App\Models\Base\History
{
	protected $fillable = [
		'user_id',
		'record_id',
		'title',
		'description',
		'type',
		'action'
	];
}
