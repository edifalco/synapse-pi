<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Workpackage
 *
 * @package App
 * @property string $wp_id
 * @property string $name
 * @property string $project
 * @property integer $order
*/
class Workpackage extends Model
{
    use SoftDeletes;

    protected $fillable = ['wp_id', 'name', 'order', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'wp_id',
        'name',
    ];
    
    public static function boot()
    {
        parent::boot();

        Workpackage::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
    public function deliverables() {
        return $this->hasMany(Deliverable::class, 'workpackages_id');
    }
}
