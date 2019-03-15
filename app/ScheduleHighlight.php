<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ScheduleHighlight
 *
 * @package App
 * @property string $name
*/
class ScheduleHighlight extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ScheduleHighlight::observe(new \App\Observers\UserActionsObserver);
    }
    
}
