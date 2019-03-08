<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MemberPartner
 *
 * @package App
 * @property string $member
 * @property string $partner
*/
class MemberPartner extends Model
{
    use SoftDeletes;

    protected $fillable = ['member_id', 'partner_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        MemberPartner::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setMemberIdAttribute($input)
    {
        $this->attributes['member_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPartnerIdAttribute($input)
    {
        $this->attributes['partner_id'] = $input ? $input : null;
    }
    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id')->withTrashed();
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id')->withTrashed();
    }
    
}
