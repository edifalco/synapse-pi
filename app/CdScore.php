<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CdScore
 *
 * @package App
 * @property integer $month
 * @property double $value
 * @property string $project
*/
class CdScore extends Model
{
    use SoftDeletes;

    protected $fillable = ['month', 'value', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        CdScore::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMonthAttribute($input)
    {
        $this->attributes['month'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setValueAttribute($input)
    {
        if ($input != '') {
            $this->attributes['value'] = $input;
        } else {
            $this->attributes['value'] = null;
        }
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
