<?php

namespace App\Models;

/**
 * App\Models\TypeCall
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Call[] $calls
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TypeCall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TypeCall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TypeCall query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TypeCall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TypeCall whereName($value)
 * @mixin \Eloquent
 */
class TypeCall extends \App\Models\Base\TypeCall
{
	protected $fillable = [
		'name'
	];
    
    /**
     * @return array
     */
    public static function toSelect()
    {
        $objReturn = [];
        $types = self::all();
        
        foreach ($types as $type) {
            $objReturn += [$type->id => $type->name];
        }
        
        return $objReturn;
    }
}
