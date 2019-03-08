<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deliverable
 *
 * @package App
 * @property string $label_identification
 * @property text $title
 * @property text $short_title
 * @property string $date
 * @property string $idStatus
 * @property text $notes
 * @property string $project
 * @property integer $confidentiality
 * @property string $submission_date
 * @property integer $due_date_months
*/
class Deliverable extends Model
{
    use SoftDeletes;

    protected $fillable = ['label_identification', 'title', 'short_title', 'date', 'notes', 'confidentiality', 'submission_date', 'due_date_months', 'idstatus_id', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'label_identification',
        'title',
        'short_title',
        'notes',
        'submission_date',
    ];
    
    public static function boot()
    {
        parent::boot();

        Deliverable::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdStatusIdAttribute($input)
    {
        $this->attributes['idStatus_id'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setConfidentialityAttribute($input)
    {
        $this->attributes['confidentiality'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSubmissionDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['submission_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['submission_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSubmissionDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDueDateMonthsAttribute($input)
    {
        $this->attributes['due_date_months'] = $input ? $input : null;
    }
    
    public function idStatus()
    {
        return $this->belongsTo(DeliverableStatus::class, 'idStatus_id');
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}
