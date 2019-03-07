<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Scoredescription
 *
 * @package App
 * @property text $description
 * @property string $project
 * @property integer $score_id
*/
class Scoredescription extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'score_id', 'project_id'];
    protected $hidden = [];
    
    

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
    public function setScoreIdAttribute($input)
    {
        $this->attributes['score_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
