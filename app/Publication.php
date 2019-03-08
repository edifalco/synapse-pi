<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Publication
 *
 * @package App
 * @property string $title
 * @property string $year
 * @property integer $month
 * @property string $abbr
 * @property string $link
 * @property string $project
 * @property string $authors
*/
class Publication extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'year', 'month', 'abbr', 'link', 'authors', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'abbr',
        'link',
        'authors',
    ];
    
    public static function boot()
    {
        parent::boot();

        Publication::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMonthAttribute($input)
    {
        $this->attributes['month'] = $input ? $input : null;
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
