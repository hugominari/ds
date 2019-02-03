<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\QueryException;

/**
 * App\Models\Mandatory
 *
 * @property int                                                                $id
 * @property string                                                             $name
 * @property \Illuminate\Support\Carbon                                         $date_start
 * @property \Illuminate\Support\Carbon                                         $date_end
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $members
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mandatory whereName($value)
 * @mixin \Eloquent
 */
class Mandatory extends \App\Models\Base\Mandatory
{
    protected $fillable = ['name', 'date_start', 'date_end'];
    
    public function setDateStartAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['date_start'] = Carbon::createFromFormat(
                'd/m/Y', $value
            )->format('Y-m-d');
        }
    }
    
    public function setDateEndAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['date_end'] = Carbon::createFromFormat(
                'd/m/Y', $value
            )->format('Y-m-d');
        }
    }
    
    public function getDirectors($count = false, $byPosition = false)
    {
        $membersId = MemberMandatory::query()
            ->where('mandatory_id', '=', $this->id)
            ->whereHas('position', function($query) {
                $query->where('type', Position::TYPE_DIRECTORS);
            })
            ->when(!$byPosition, function($query){
                return $query->select('member_id');
            })
            ->get();
    
        $members = Member::query()->whereIn('id', $membersId->toArray())->get();
    
        if ($count) {
            return $members->count();
        }
    
        if ($byPosition) {
            $members = [];
            foreach ($membersId as $member)
            {
                $user = $member->member;
            
                $members[$member->position_id] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->image->url_sm,
                ];
            }
        }
    
        return $members;
    }
    
    public function getFiscals($count = false, $byPosition = false)
    {
        $membersId = MemberMandatory::query()
            ->where('mandatory_id', '=', $this->id)
            ->whereHas('position', function($query) {
                $query->where('type', Position::TYPE_FISCALS);
            })
            ->when(!$byPosition, function($query){
                return $query->select('member_id');
            })
            ->get();
        
        $members = Member::query()->whereIn('id', $membersId->toArray())->get();
        
        if ($count) {
            return $members->count();
        }
        
        if ($byPosition) {
            $members = [];
            foreach ($membersId as $member)
            {
                $user = $member->member;
                
                $members[$member->position_id] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image' => $user->image->url_sm,
                ];
            }
        }
        
        return $members;
    }
    
    public function getMembersIds()
    {
        return MemberMandatory::query()
            ->select('member_id')
            ->where('mandatory_id', '=', $this->id)
            ->get()->toArray();
    }
    
    public function releaseMemberMandatory()
    {
        try
        {
            MemberMandatory::query()
                ->where('mandatory_id', '=', $this->id)
                ->delete();
        }
        catch(QueryException $ex)
        {
            \Log::debug($ex);
        }
    }
}
