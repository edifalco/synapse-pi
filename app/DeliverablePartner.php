<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeliverablePartner
 *
 * @package App
 * @property string $partner
 * @property string $deliverable
*/
class DeliverablePartner extends Model
{
    use SoftDeletes;

    protected $fillable = ['partner_id', 'deliverable_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPartnerIdAttribute($input)
    {
        $this->attributes['partner_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDeliverableIdAttribute($input)
    {
        $this->attributes['deliverable_id'] = $input ? $input : null;
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id')->withTrashed();
    }
    
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id')->withTrashed();
    }
    
}
