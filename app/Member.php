<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member
 *
 * @package App
 * @property string $name
 * @property string $surname
 * @property string $partner
 * @property string $email
 * @property string $phone
 * @property text $notes
*/
class Member extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'surname', 'email', 'phone', 'notes', 'partner_id'];
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
