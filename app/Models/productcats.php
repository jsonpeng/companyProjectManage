<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class productcats
 * @package App\Models
 * @version November 8, 2017, 1:24 am UTC
 *
 * @property string name
 * @property string des
 */
class productcats extends Model
{
    use SoftDeletes;

    public $table = 'productcats';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'des'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'des' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string|required'
    ];

    /*
     * 所属产品
     */
    public function cats(){
        return $this->belongsToMany('App\Models\products','productcat_product','productcat_id','product_id');
    }

    
}
