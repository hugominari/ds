<?php

namespace App\Models;

/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $name
 * @property int|null $type
 * @property-read string $type_text
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MemberMandatory[] $member_mandatories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereType($value)
 * @mixin \Eloquent
 */
class Position extends \App\Models\Base\Position
{
    protected $fillable
        = ['name', 'type'];
    
    protected $appends
        = array('type_text');
    
    const TYPE_DIRECTORS = 1;
    const TYPE_FISCALS = 2;
    
    /**
     * @return string
     */
    public function getTypeTextAttribute()
    {
        switch ($this->type) {
            case self::TYPE_DIRECTORS:
                $text = 'Diretoria';
                break;
            default:
                $text = 'Conselho Fiscal';
                break;
        }
        
        return $text;
    }
    
    /**
     * @return array
     */
    public static function getTypes()
    {
        return [self::TYPE_DIRECTORS => 'Diretoria',
                self::TYPE_FISCALS   => 'Conselho Fiscal',];
    }
    
    /**
     * @return array
     */
    public static function toSelect($type = null)
    {
        $objReturn = [];
        
        if(!empty($type))
        {
            $positions = self::whereType($type)->get();
        }
        else
        {
            $positions = self::all();
        }
        
        foreach ($positions as $position) {
            $objReturn += [$position->id => $position->name];
        }
        
        return $objReturn;
    }
}
