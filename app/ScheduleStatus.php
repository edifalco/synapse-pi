<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ScheduleStatus
 *
 * @package App
 * @property string $name
*/
class ScheduleStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ScheduleStatus::observe(new \App\Observers\UserActionsObserver);
    }
    
}
