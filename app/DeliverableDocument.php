<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DeliverableDocument
 *
 * @package App
 * @property string $deliverable
 * @property string $document
*/
class DeliverableDocument extends Model
{
    use SoftDeletes;

    protected $fillable = ['deliverable_id', 'document_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        DeliverableDocument::observe(new \App\Observers\UserActionsObserver);
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
    public function setDocumentIdAttribute($input)
    {
        $this->attributes['document_id'] = $input ? $input : null;
    }
    
    public function deliverable()
    {
        return $this->belongsTo(Deliverable::class, 'deliverable_id')->withTrashed();
    }
    
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id')->withTrashed();
    }
    
}
