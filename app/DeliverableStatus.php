<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliverableStatus
 *
 * @package App
 * @property string $label
*/
class DeliverableStatus extends Model
{
    protected $fillable = ['label'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        DeliverableStatus::observe(new \App\Observers\UserActionsObserver);
    }
    
}
