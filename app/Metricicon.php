<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Metricicon
 *
 * @package App
 * @property integer $metric_id
 * @property integer $icon_id
 * @property string $project
*/
class Metricicon extends Model
{
    use SoftDeletes;

    protected $fillable = ['metric_id', 'icon_id', 'project_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Metricicon::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMetricIdAttribute($input)
    {
        $this->attributes['metric_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setIconIdAttribute($input)
    {
        $this->attributes['icon_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
