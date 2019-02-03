<?php

namespace App\Models;

use App\Http\Controllers\DefaultController;
use Carbon\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $local
 * @property int $type
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read string $image
 * @property-read string $type_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $resume
 */
class Event extends \App\Models\Base\Event
{
    protected $fillable
        = ['title', 'description', 'date', 'local', 'type'];
    
    protected $dates
        = ['created_at', 'updated_at', 'date'];
    
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
    ];
    
    protected $appends
        = array('type_text', 'image', 'resume');
    
    const TYPE_EVENT = 1;
    const TYPE_CULTURES = 2;
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d H:i:s');
    }
    
    /**
     * Function to set image append
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getImageAttribute()
    {
        $folder = ($this->type == self::TYPE_CULTURES) ? 'cultures' : 'events';
        $default = new DefaultController();
        return $default->getFile("public/{$folder}/{$this->id}", 'image');
    }
    
    /**
     * Function to set image append
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getResumeAttribute()
    {
        $description = strip_tags($this->description);
        return substr($description, 0, 380) . '...';
    }
    
    /**
     * @return string
     */
    public function getTypeTextAttribute()
    {
        switch ($this->type) {
            case self::TYPE_EVENT:
                $text = 'Eventos';
                break;
            default:
                $text = 'Cultura e Lazer';
                break;
        }
        
        return $text;
    }
    
    /**
     * @return array
     */
    public static function getTypes()
    {
        return [self::TYPE_EVENT    => 'Evento',
                self::TYPE_CULTURES => 'Cultura e Lazer',];
    }
    
    
    /**
     * @return bool
     */
    public function isCulture()
    {
        return $this->type == self::TYPE_CULTURES;
    }
    
    public function getAlbum()
    {
        $folder = ($this->type == self::TYPE_CULTURES) ? 'cultures' : 'events';
        $default = new DefaultController();
        $path = "public/{$folder}/{$this->id}/album";
        $album = [];
    
        $files = $default->findFile($path, 'album_pho*', false, '/^((?!thumb).)*$/');
        
        if(!empty($files))
        {
            foreach ($files as $file)
            {
                $album[] = $default->getFile($file->path, $file->filename);
            }
        }
        
        return $album;
    }
}
