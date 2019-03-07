<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CdScores2
 *
 * @package App
 * @property integer $month
 * @property integer $value
 * @property string $project
*/
class CdScores2 extends Model
{
    protected $fillable = ['month', 'value', 'project_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMonthAttribute($input)
    {
        $this->attributes['month'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setValueAttribute($input)
    {
        $this->attributes['value'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
