<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Document
 *
 * @package App
 * @property string $title
 * @property string $folder
 * @property text $document
 * @property string $project
 * @property string $deliverable
*/
class Document extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'folder', 'document', 'project_id', 'deliverable_id'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'folder',
        'document',
    ];
    
    public static function boot()
    {
        parent::boot();

        Document::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDeliverableIdAttribute($input)
    {
        $this->attributes['deliverable_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id')->withTrashed();
    }
    
}
