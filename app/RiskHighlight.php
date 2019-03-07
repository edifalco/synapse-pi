<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskHighlight
 *
 * @package App
 * @property string $risk
 * @property string $project
*/
class RiskHighlight extends Model
{
    use SoftDeletes;

    protected $fillable = ['risk_id', 'project_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRiskIdAttribute($input)
    {
        $this->attributes['risk_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function risk()
    {
        return $this->belongsTo(Risk::class, 'risk_id')->withTrashed();
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
