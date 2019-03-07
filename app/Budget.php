<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Budget
 *
 * @package App
 * @property string $partner
 * @property double $value
 * @property integer $period
 * @property string $project
*/
class Budget extends Model
{
    protected $fillable = ['value', 'period', 'partner_id', 'project_id'];
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
     * Set attribute to date format
     * @param $input
     */
    public function setValueAttribute($input)
    {
        if ($input != '') {
            $this->attributes['value'] = $input;
        } else {
            $this->attributes['value'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPeriodAttribute($input)
    {
        $this->attributes['period'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id')->withTrashed();
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
