<?php

namespace App\Repositories;

use App\Models\project_rules;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class project_rulesRepository
 * @package App\Repositories
 * @version November 13, 2017, 12:52 am UTC
 *
 * @method project_rules findWithoutFail($id, $columns = ['*'])
 * @method project_rules find($id, $columns = ['*'])
 * @method project_rules first($columns = ['*'])
*/
class project_rulesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'basic_cost',
        'first_price',
        'first_prop',
        'second_prop',
        'man_prop'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return project_rules::class;
    }
}
