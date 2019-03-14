<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Document
 *
 * @package App
 * @property string $title
 * @property string $project
 * @property string $deliverable
 * @property string $document
 * @property string $folder
*/
class Document extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'document', 'project_id', 'deliverable_id', 'folder_id'];
    protected $hidden = [];
    public static $searchable = [
        'title',
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

    /**
     * Set to null if empty
     * @param $input
     */
    public function setFolderIdAttribute($input)
    {
        $this->attributes['folder_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id')->withTrashed();
    }
    
    public function folder()
    {
        return $this->belongsTo(DocumentFolder::class, 'folder_id')->withTrashed();
    }
    
}
