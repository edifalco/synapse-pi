<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Risk
 *
 * @package App
 * @property string $code
 * @property integer $version
 * @property integer $parent_id
 * @property text $description
 * @property integer $score
 * @property string $flag
 * @property string $project
 * @property integer $impact
 * @property integer $probability
 * @property string $proximity
 * @property text $title
 * @property text $contingency
 * @property text $mitigation
 * @property text $triggerevents
 * @property integer $resolved
 * @property string $risk_date
 * @property time $version_date
 * @property integer $type
 * @property text $notes
*/
class Risk extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'version', 'parent_id', 'description', 'score', 'flag', 'impact', 'probability', 'proximity', 'title', 'contingency', 'mitigation', 'triggerevents', 'resolved', 'risk_date', 'version_date', 'type', 'notes', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'code',
        'description',
        'flag',
        'title',
        'contingency',
        'mitigation',
        'triggerevents',
        'notes',
    ];
    
    public static function boot()
    {
        parent::boot();

        Risk::observe(new \App\Observers\UserActionsObserver);
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
     * Set attribute to money format
     * @param $input
     */
    public function setParentIdAttribute($input)
    {
        $this->attributes['parent_id'] = $input ? $input : null;
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
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setImpactAttribute($input)
    {
        $this->attributes['impact'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setProbabilityAttribute($input)
    {
        $this->attributes['probability'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResolvedAttribute($input)
    {
        $this->attributes['resolved'] = $input ? $input : null;
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
    public function setTypeAttribute($input)
    {
        $this->attributes['type'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
