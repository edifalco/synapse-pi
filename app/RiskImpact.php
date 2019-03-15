<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskImpact
 *
 * @package App
 * @property string $name
*/
class RiskImpact extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        RiskImpact::observe(new \App\Observers\UserActionsObserver);
    }
    
}
