<?php

namespace App\Models;

use App\Http\Controllers\DefaultController;
use Carbon\Carbon;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $cpf
 * @property \Illuminate\Support\Carbon|null $birth_date
 * @property-read string $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MemberMandatory[] $member_mandatories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Member wherePhone($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mandatory[] $mandatories
 */
class Member extends \App\Models\Base\Member
{
	protected $fillable = [
		'name',
		'email',
		'phone',
		'cpf',
		'birth_date'
	];
	
    protected $appends = array(
        'image',
    );
    
    protected $casts = [
        'birth_date' => 'date:d/m/Y',
    ];
    
    /**
     * Function to set image append
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getImageAttribute()
    {
        $default = new DefaultController();
        return $default->getFile("public/members/{$this->id}", 'image');
    }
    
    public function setBirthDateAttribute($value)
    {
        if(!empty($value))
            $this->attributes['birth_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d H:i:s');
    }
    
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = getOnlyNumbers($value);
    }
    
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = getOnlyNumbers($value);
    }
}
