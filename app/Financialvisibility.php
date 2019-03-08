<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Financialvisibility
 *
 * @package App
 * @property string $type
 * @property integer $status
 * @property string $id_project
*/
class Financialvisibility extends Model
{
    use SoftDeletes;

    protected $fillable = ['type', 'status', 'id_project_id'];
    protected $hidden = [];
    public static $searchable = [
        'type',
    ];
    
    public static function boot()
    {
        parent::boot();

        Financialvisibility::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setStatusAttribute($input)
    {
        $this->attributes['status'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdProjectIdAttribute($input)
    {
        $this->attributes['id_project_id'] = $input ? $input : null;
    }
    
    public function id_project()
    {
        return $this->belongsTo(Project::class, 'id_project_id')->withTrashed();
    }
    
}
