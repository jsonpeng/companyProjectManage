<?php

namespace App\Repositories;

use App\Models\productcats;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class productcatsRepository
 * @package App\Repositories
 * @version November 8, 2017, 1:24 am UTC
 *
 * @method productcats findWithoutFail($id, $columns = ['*'])
 * @method productcats find($id, $columns = ['*'])
 * @method productcats first($columns = ['*'])
*/
class productcatsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'des'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return productcats::class;
    }
}
