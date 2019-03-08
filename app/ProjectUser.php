<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectUser
 *
 * @package App
 * @property string $userID
 * @property string $projectID
*/
class ProjectUser extends Model
{
    use SoftDeletes;

    protected $fillable = ['userid_id', 'projectid_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ProjectUser::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIDIdAttribute($input)
    {
        $this->attributes['userID_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIDIdAttribute($input)
    {
        $this->attributes['projectID_id'] = $input ? $input : null;
    }
    
    public function userID()
    {
        return $this->belongsTo(User::class, 'userID_id');
    }
    
    public function projectID()
    {
        return $this->belongsTo(Project::class, 'projectID_id')->withTrashed();
    }
    
}
