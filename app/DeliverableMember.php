<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeliverableMember
 *
 * @package App
 * @property string $member
 * @property string $deliverable
*/
class DeliverableMember extends Model
{
    use SoftDeletes;

    protected $fillable = ['member_id', 'deliverable_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setMemberIdAttribute($input)
    {
        $this->attributes['member_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDeliverableIdAttribute($input)
    {
        $this->attributes['deliverable_id'] = $input ? $input : null;
    }
    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id')->withTrashed();
    }
    
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id')->withTrashed();
    }
    
}
