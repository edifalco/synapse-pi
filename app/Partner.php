<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Partner
 *
 * @package App
 * @property text $name
 * @property string $acronym
 * @property string $image
 * @property string $country
*/
class Partner extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'acronym', 'image', 'country'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Partner::observe(new \App\Observers\UserActionsObserver);
    }
    
}
