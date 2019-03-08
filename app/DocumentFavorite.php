<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentFavorite
 *
 * @package App
 * @property string $document
 * @property string $project
*/
class DocumentFavorite extends Model
{
    use SoftDeletes;

    protected $fillable = ['document_id', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        DocumentFavorite::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDocumentIdAttribute($input)
    {
        $this->attributes['document_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id')->withTrashed();
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
