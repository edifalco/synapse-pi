<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentFolder
 *
 * @package App
 * @property string $name
*/
class DocumentFolder extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];
    
    public static function boot()
    {
        parent::boot();

        DocumentFolder::observe(new \App\Observers\UserActionsObserver);
    }
    
}
