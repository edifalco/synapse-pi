<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskProximity
 *
 * @package App
 * @property string $name
*/
class RiskProximity extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        RiskProximity::observe(new \App\Observers\UserActionsObserver);
    }
    
}
