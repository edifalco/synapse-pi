<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Risk
 *
 * @package App
 * @property string $project
 * @property string $code
 * @property integer $version
 * @property tinyInteger $flag
 * @property tinyInteger $resolved
 * @property string $risks_type
 * @property string $risk_date
 * @property text $title
 * @property text $description
 * @property text $trigger_events
 * @property string $risk_impact
 * @property string $risk_probabilities
 * @property integer $score
 * @property string $risk_proximity
 * @property text $mitigation
 * @property text $notes
 * @property text $contingency
 * @property time $version_date
 * @property integer $parent_id
*/
class Risk extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'version', 'flag', 'resolved', 'risk_date', 'title', 'description', 'trigger_events', 'score', 'mitigation', 'notes', 'contingency', 'version_date', 'parent_id', 'project_id', 'risks_type_id', 'risk_impact_id', 'risk_probabilities_id', 'risk_proximity_id'];
    protected $hidden = [];
    public static $searchable = [
        'code',
        'title',
        'description',
        'trigger_events',
        'mitigation',
        'notes',
        'contingency',
    ];
    
    public static function boot()
    {
        parent::boot();

        Risk::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setVersionAttribute($input)
    {
        $this->attributes['version'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRisksTypeIdAttribute($input)
    {
        $this->attributes['risks_type_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setRiskDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['risk_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['risk_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getRiskDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRiskImpactIdAttribute($input)
    {
        $this->attributes['risk_impact_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRiskProbabilitiesIdAttribute($input)
    {
        $this->attributes['risk_probabilities_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setScoreAttribute($input)
    {
        $this->attributes['score'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRiskProximityIdAttribute($input)
    {
        $this->attributes['risk_proximity_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setVersionDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['version_date'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            $this->attributes['version_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getVersionDateAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setParentIdAttribute($input)
    {
        $this->attributes['parent_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
    public function risks_type()
    {
        return $this->belongsTo(RiskType::class, 'risks_type_id')->withTrashed();
    }
    
    public function risk_impact()
    {
        return $this->belongsTo(RiskImpact::class, 'risk_impact_id')->withTrashed();
    }
    
    public function risk_probabilities()
    {
        return $this->belongsTo(RiskProbability::class, 'risk_probabilities_id')->withTrashed();
    }
    
    public function risk_proximity()
    {
        return $this->belongsTo(RiskProximity::class, 'risk_proximity_id')->withTrashed();
    }
    
    public function risk_owner()
    {
        return $this->belongsToMany(Member::class, 'member_risk')->withTrashed();
    }
    
}
