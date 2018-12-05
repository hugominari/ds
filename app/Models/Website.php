<?php

namespace App\Models;

/**
 * App\Models\Website
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $type
 * @property-read string $type_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Website whereUrl($value)
 * @mixin \Eloquent
 */
class Website extends \App\Models\Base\Website
{
    protected $fillable
        = ['name', 'url', 'type'];
    
    protected $appends = array(
        'type_text'
    );
    
    const TYPE_UTILS = 1;
    const TYPE_EDUCATIVE = 2;
    
    /**
     * @return string
     */
    public function getTypeTextAttribute()
    {
        switch ($this->type){
            case self::TYPE_EDUCATIVE:
                $text = 'Educativo';
                break;
            default:
                $text = 'Úteis';
                break;
        }
        
        return $text;
    }
    
    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_UTILS => 'Úteis',
            self::TYPE_EDUCATIVE => 'Educativo',
        ];
    }
}
