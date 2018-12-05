<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Contact
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $text
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Base
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Contact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Base\Contact withoutTrashed()
 * @mixin \Eloquent
 */
class Contact extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'status' => 'int'
	];
}
