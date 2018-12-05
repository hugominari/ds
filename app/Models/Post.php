<?php

namespace App\Models;

use App\Http\Controllers\DefaultController;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $type
 * @property string $title
 * @property string $description
 * @property string|null $source
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property string|null $deleted_at
 * @property-read string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $resume
 * @property-read string $tag
 * @property-read string $type_text
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withoutTrashed()
 */
class Post extends \App\Models\Base\Post
{
    use SoftDeletes;
    
	protected $fillable = [
		'title',
		'type',
		'description',
		'source'
	];
	
	protected $casts = [
		'created_at' => 'datetime:d/m/Y H:i:s',
		'updated_at' => 'datetime:d/m/Y H:i:s',
	];
	
	/**
	 * Append some virtual columns at retrive
	 * @var array
	 */
	protected $appends = array(
		'image',
		'type_text',
		'tag',
		'resume',
	);
	
	/**
	 * Function to set image append
	 * @return string
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function getImageAttribute()
	{
		$default = new DefaultController();
		return $default->getFile("public/posts/{$this->id}", 'image.jpg');
	}
    
    /**
     * Function to set image append
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getTypeTextAttribute()
    {
        return self::getType($this->type)->text;
    }
    
    /**
     * Function to set image append
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getTagAttribute()
    {
        return self::getType($this->type)->tag;
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
	
	const TYPE_BOLETIM                  =   1;
	const TYPE_CONVOCACAO               =   2;
	const TYPE_NOTICIA                  =   3;
	const TYPE_EDITAL                   =   4;
	const TYPE_COMUNICADO               =   5;
	
	/**
	 * @param $status
	 * @return object
	 */
	public static function getType($type = null)
	{
		switch($type)
		{
			case self::TYPE_BOLETIM:
			case 'boletim':
				$int = self::TYPE_BOLETIM;
				$text = 'Boletim';
				$icon = '<i class="fas fa-file-alt pr-2"></i>';
                $class = 'text-success';
				break;
			case self::TYPE_CONVOCACAO:
			case 'convocacao':
				$int = self::TYPE_CONVOCACAO;
				$text = 'Convocação';
                $icon = '<i class="fas fa-bullhorn pr-2"></i>';
                $class = 'text-danger';
				break;
			case self::TYPE_EDITAL:
			case 'edital':
				$int = self::TYPE_EDITAL;
				$text = 'Edital';
                $icon = '<i class="fas fa-file-pdf pr-2"></i>';
                $class = 'text-info';
				break;
			case self::TYPE_COMUNICADO:
			case 'comunicado':
				$int = self::TYPE_COMUNICADO;
				$text = 'Comunicado';
                $icon = '<i class="fas fa-exclamation-circle pr-2"></i>';
                $class = 'text-warning';
				break;
			default:
				$int = self::TYPE_NOTICIA;
				$text = 'Notícia';
                $icon = '<i class="far fa-newspaper pr-2"></i>';
                $class = 'text-blue';
				break;
		}
		
		return (object)[
			'int' => $int,
			'text' => $text,
			'tag' => "<span class='$class'> {$icon} {$text}</span>",
		];
	}
	
}
