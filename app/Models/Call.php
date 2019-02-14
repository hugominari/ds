<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * App\Models\Call
 *
 * @property int $id
 * @property int $type_call_id
 * @property int $user_id
 * @property string $name
 * @property string $cpf
 * @property int $status
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TypeCall $type_call
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereTypeCallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereUserId($value)
 * @mixin \Eloquent
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Call whereDescription($value)
 */
class Call extends \App\Models\Base\Call
{
	protected $fillable = [
		'type_call_id',
		'user_id',
		'name',
		'cpf',
		'status',
		'date'
	];
    
    public function setDateAttribute($value)
    {
        if(!empty($value))
            $this->attributes['date'] = Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s');
        else
            $this->attributes['date'] = Carbon::now();
    }
}
