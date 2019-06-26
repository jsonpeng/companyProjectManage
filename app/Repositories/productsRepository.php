<?php

namespace App\Repositories;

use App\Models\products;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class productsRepository
 * @package App\Repositories
 * @version November 8, 2017, 1:35 am UTC
 *
 * @method products findWithoutFail($id, $columns = ['*'])
 * @method products find($id, $columns = ['*'])
 * @method products first($columns = ['*'])
*/
class productsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'des',
        'main_man',
        'whether_project'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return products::class;
    }
}
