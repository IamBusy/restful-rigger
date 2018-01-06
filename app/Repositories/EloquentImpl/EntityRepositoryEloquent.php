<?php

namespace App\Repositories\EloquentImpl;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EntityRepository;
use App\Entities\Entity;

/**
 * Class EntityRepositoryEloquent
 * @package namespace App\Repositories\EloquentImpl;
 */
class EntityRepositoryEloquent extends BaseRepository implements EntityRepository
{
    protected $modelName;


    public function setModelName($name) {
        $this->modelName = $name;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if($this->modelName) {
            return $this->modelName;
        }
        return Entity::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
