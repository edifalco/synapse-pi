<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectPeriod
 *
 * @package App
 * @property string $date
 * @property string $period_num
 * @property string $project
*/
class ProjectPeriod extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'period_num', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'period_num',
    ];
    
    public static function boot()
    {
        parent::boot();

        ProjectPeriod::observe(new \App\Observers\UserActionsObserver);
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
