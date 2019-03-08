<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AcronymProject
 *
 * @package App
 * @property string $acronym
 * @property string $partner
 * @property string $project
*/
class AcronymProject extends Model
{
    use SoftDeletes;

    protected $fillable = ['acronym_id', 'partner_id', 'project_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        AcronymProject::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAcronymIdAttribute($input)
    {
        $this->attributes['acronym_id'] = $input ? $input : null;
    }

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
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function acronym()
    {
        return $this->belongsTo(Acronym::class, 'acronym_id')->withTrashed();
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
