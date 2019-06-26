<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class project_rules
 * @package App\Models
 * @version November 13, 2017, 12:52 am UTC
 *
 * @property float basic_cost
 * @property float first_price
 * @property float first_prop
 * @property float second_prop
 */
class project_rules extends Model
{
    use SoftDeletes;

    public $table = 'project_rules';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'basic_cost',
        'first_price',
        'first_prop',
        'second_prop',
        'man_prop'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'basic_cost' => 'float',
        'first_price' => 'float',
        'first_prop' => 'float',
        'second_prop' => 'float',
        'man_prop'=>'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'basic_cost' => 'required',
        'first_price' => 'required',
        'first_prop' => 'required',
        'second_prop' => 'required'
    ];

    
}
