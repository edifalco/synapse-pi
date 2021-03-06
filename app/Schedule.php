<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule
 *
 * @package App
 * @property string $description
 * @property string $date
 * @property string $project
 * @property string $status
 * @property string $highlight
*/
class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'date', 'project_id', 'status_id', 'highlight_id'];
    protected $hidden = [];
    public static $searchable = [
        'description',
    ];
    
    public static function boot()
    {
        parent::boot();

        Schedule::observe(new \App\Observers\UserActionsObserver);
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
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setStatusIdAttribute($input)
    {
        $this->attributes['status_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setHighlightIdAttribute($input)
    {
        $this->attributes['highlight_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
    public function status()
    {
        return $this->belongsTo(ScheduleStatus::class, 'status_id')->withTrashed();
    }
    
    public function highlight()
    {
        return $this->belongsTo(ScheduleHighlight::class, 'highlight_id')->withTrashed();
    }
    
}
