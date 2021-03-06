<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ThresholdRisk
 *
 * @package App
 * @property integer $value
 * @property string $project
*/
class ThresholdRisk extends Model
{
    use SoftDeletes;

    protected $fillable = ['value', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ThresholdRisk::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setValueAttribute($input)
    {
        $this->attributes['value'] = $input ? $input : null;
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
