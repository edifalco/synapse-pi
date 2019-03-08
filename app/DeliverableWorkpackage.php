<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeliverableWorkpackage
 *
 * @package App
 * @property string $deliverable
 * @property string $workpackage
*/
class DeliverableWorkpackage extends Model
{
    use SoftDeletes;

    protected $fillable = ['deliverable_id', 'workpackage_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        DeliverableWorkpackage::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDeliverableIdAttribute($input)
    {
        $this->attributes['deliverable_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setWorkpackageIdAttribute($input)
    {
        $this->attributes['workpackage_id'] = $input ? $input : null;
    }
    
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id')->withTrashed();
    }
    
    public function workpackage()
    {
        return $this->belongsTo(Workpackage::class, 'workpackage_id')->withTrashed();
    }
    
}
