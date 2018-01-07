<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{

    protected $repository;


    public function index(Request $request) {
        $this->repository = $this->resolveRepository($request);
        return $this->repository->all();
    }

    public function show(Request $request, $id) {
        $this->repository = $this->resolveRepository($request);
        return $this->repository->find($id);
    }

    public function update(Request $request, $id) {
        $this->repository = $this->resolveRepository($request);
        $payload = $request->all();
        return $this->repository->update($payload, $id);
    }

    public function store(Request $request) {
        $this->repository = $this->resolveRepository($request);
        $payload = $request->all();
        return $this->repository->create($payload);

    }

    public function destroy(Request $request, $id) {
        $this->repository = $this->resolveRepository($request);
        $this->repository->delete($id);
    }

    protected function resolveRepository(Request $request) {
        return app('App\Repositories\\'.$request->attributes->get('rigger_entity').'Repository');
    }

    protected function resolveEntity(Request $request) {

        return app('App\Entities\\'.$request->attributes->get('rigger_entity'));
    }
}
