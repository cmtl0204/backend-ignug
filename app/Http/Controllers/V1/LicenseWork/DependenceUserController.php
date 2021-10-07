<?php

namespace App\Http\Controllers\V1\LicenseWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LicenseWork\DependenceUser\DestroysDependenceUserRequest;
use App\Http\Requests\V1\LicenseWork\DependenceUser\IndexDependenceUserRequest;
use App\Http\Requests\V1\LicenseWork\DependenceUser\StoreDependenceRequest;
use App\Http\Requests\V1\LicenseWork\DependenceUser\UpdateDependenceUserRequest;
use App\Http\Resources\V1\LicenseWork\DependenceUserCollection;
use App\Http\Resources\V1\LicenseWork\DependenceUserResource;
use App\Models\LicenseWork\DependenceUser;
use Illuminate\Http\Request;

class DependenceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexDependenceUserRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $dependenceUser = DependenceUser::customOrderBy($sorts)
            ->name($request->input('name'))
            ->paginate($request->per_page);

        return (new DependenceUserCollection($dependenceUser))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDependenceUserRequest $request)
    {
        $dependenceUser = new DependenceUser();

        $dependenceUser->name = $request->input('name');
        $dependenceUser->save();

        return (new DependenceUserResource($dependenceUser))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DependenceUser $dependenceUser)
    {
        return (new dependenceUserResource($dependenceUser))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDependenceUserRequest $request, DependenceUser $dependenceUser)
    {

        $dependenceUser->name = $request->input('name');
        $dependenceUser->save();

        return (new DependenceUserResource($dependenceUser))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DependenceUser $dependenceUser)
    {
        $dependenceUser->delete();
        return (new DependenceUserResource($dependenceUser))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysDependenceUserRequest $request)
    {
        $dependenceUser = DependenceUserResource::whereIn('id', $request->input('ids'))->get();
        DependenceResource::destroys($request->input('ids');

        return (new DependenceCollection($dependenceUser))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}

