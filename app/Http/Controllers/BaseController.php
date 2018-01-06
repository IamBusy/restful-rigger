<?php

namespace App\Http\Controllers;

use App\Repositories\EntityRepository;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $repository;


    public function index(Request $request) {
        $this->repository = $this->resolveRepository($request);
        return $this->repository->all();
    }

    protected function resolveRepository(Request $request) {
        return app('App\Repositories\\'.$request['rigger_entity'].'Repository');
    }

    protected function resolveEntity(Request $request) {
        return app('App\Entities\\'.$request['rigger_entity']);
    }
}
