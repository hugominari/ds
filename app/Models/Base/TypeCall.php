<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TypeCall
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection $calls
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\TypeCall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\TypeCall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\TypeCall query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\TypeCall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\TypeCall whereName($value)
 * @mixin \Eloquent
 */
class TypeCall extends Eloquent
{
	public $timestamps = false;

	public function calls()
	{
		return $this->hasMany(\App\Models\Call::class);
	}
}
