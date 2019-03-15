<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RiskType
 *
 * @package App
 * @property string $name
*/
class RiskType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        RiskType::observe(new \App\Observers\UserActionsObserver);
    }
    
}
