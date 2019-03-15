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
 * @property string $type
 * @property string $date
 * @property text $title
 * @property text $description
 * @property text $trigger_events
 * @property string $impact
 * @property string $probability
 * @property string $proximity
 * @property integer $score
 * @property text $mitigation
 * @property string $owner
 * @property text $notes
 * @property text $contingency
 * @property time $version_date
 * @property integer $parent_id
*/
class Risk extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'version', 'flag', 'resolved', 'date', 'title', 'description', 'trigger_events', 'score', 'mitigation', 'notes', 'contingency', 'version_date', 'parent_id', 'project_id', 'type_id', 'impact_id', 'probability_id', 'proximity_id', 'owner_id'];
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
    public function setTypeIdAttribute($input)
    {
        $this->attributes['type_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
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
    public function setImpactIdAttribute($input)
    {
        $this->attributes['impact_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProbabilityIdAttribute($input)
    {
        $this->attributes['probability_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProximityIdAttribute($input)
    {
        $this->attributes['proximity_id'] = $input ? $input : null;
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
    public function setOwnerIdAttribute($input)
    {
        $this->attributes['owner_id'] = $input ? $input : null;
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
    
    public function type()
    {
        return $this->belongsTo(RiskType::class, 'type_id')->withTrashed();
    }
    
    public function impact()
    {
        return $this->belongsTo(RiskImpact::class, 'impact_id')->withTrashed();
    }
    
    public function probability()
    {
        return $this->belongsTo(RiskProbability::class, 'probability_id')->withTrashed();
    }
    
    public function proximity()
    {
        return $this->belongsTo(RiskProximity::class, 'proximity_id')->withTrashed();
    }
    
    public function owner()
    {
        return $this->belongsTo(Member::class, 'owner_id')->withTrashed();
    }
    
}
