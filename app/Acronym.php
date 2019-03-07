<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Acronym
 *
 * @package App
 * @property text $acronym
 * @property string $partner
*/
class Acronym extends Model
{
    use SoftDeletes;

    protected $fillable = ['acronym', 'partner_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPartnerIdAttribute($input)
    {
        $this->attributes['partner_id'] = $input ? $input : null;
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id')->withTrashed();
    }
    
}
