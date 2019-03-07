<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskMreporter
 *
 * @package App
 * @property string $member
 * @property string $risk
*/
class RiskMreporter extends Model
{
    use SoftDeletes;

    protected $fillable = ['member_id', 'risk_id'];
    protected $hidden = [];
    
    

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
    public function setRiskIdAttribute($input)
    {
        $this->attributes['risk_id'] = $input ? $input : null;
    }
    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id')->withTrashed();
    }
    
    public function risk()
    {
        return $this->belongsTo(Risk::class, 'risk_id')->withTrashed();
    }
    
}
