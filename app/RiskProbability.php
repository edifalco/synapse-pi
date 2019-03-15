<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskProbability
 *
 * @package App
 * @property string $name
*/
class RiskProbability extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        RiskProbability::observe(new \App\Observers\UserActionsObserver);
    }
    
}
