<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskPreporter
 *
 * @package App
 * @property string $partner
 * @property string $risk
*/
class RiskPreporter extends Model
{
    use SoftDeletes;

    protected $fillable = ['partner_id', 'risk_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPartnerIdAttribute($input)
    {
        $this->attributes['partner_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRiskIdAttribute($input)
    {
        $this->attributes['risk_id'] = $input ? $input : null;
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id')->withTrashed();
    }
    
    public function risk()
    {
        return $this->belongsTo(Risk::class, 'risk_id')->withTrashed();
    }
    
}
