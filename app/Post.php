<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 *
 * @package App
 * @property string $created
 * @property string $idUser
 * @property text $description
 * @property string $idProject
*/
class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['created', 'description', 'iduser_id', 'idproject_id'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setCreatedAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['created'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['created'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getCreatedAttribute($input)
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
    public function setIdUserIdAttribute($input)
    {
        $this->attributes['idUser_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdProjectIdAttribute($input)
    {
        $this->attributes['idProject_id'] = $input ? $input : null;
    }
    
    public function idUser()
    {
        return $this->belongsTo(User::class, 'idUser_id');
    }
    
    public function idProject()
    {
        return $this->belongsTo(Project::class, 'idProject_id')->withTrashed();
    }
    
}
