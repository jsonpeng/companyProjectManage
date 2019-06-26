<?php

namespace App\Repositories;

use App\Models\project;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class projectRepository
 * @package App\Repositories
 * @version November 8, 2017, 6:25 am UTC
 *
 * @method project findWithoutFail($id, $columns = ['*'])
 * @method project find($id, $columns = ['*'])
 * @method project first($columns = ['*'])
*/
class projectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'main_man',
        'start_time',
        'end_time',
        'status',
        'des',
        'price',
        'product_id',
        'basic_time'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return project::class;
    }
}
