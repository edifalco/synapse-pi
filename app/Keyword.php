<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Keyword
 *
 * @package App
 * @property string $word
*/
class Keyword extends Model
{
    use SoftDeletes;

    protected $fillable = ['word'];
    protected $hidden = [];
    
    
    
}
