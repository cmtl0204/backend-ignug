<?php

namespace App\Http\Controllers\V1\LicenseWork;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LicenseWork\Dependence\DestroysDependenceRequest;
use App\Http\Requests\V1\LicenseWork\Dependence\IndexDependenceRequest;
use App\Http\Requests\V1\LicenseWork\Dependence\StoreDependenceRequest;
use App\Http\Requests\V1\LicenseWork\Dependence\UpdateDependenceRequest;
use App\Http\Resources\V1\LicenseWork\DependenceCollection;
use App\Http\Resources\V1\LicenseWork\DependenceResource;
use App\Models\Authentication\User;
use App\Models\Core\State;
use App\Models\LicenseWork\Application;
use App\Models\LicenseWork\Dependence;
use Illuminate\Http\Request;

  //holagggggg
class DependenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexDependenceRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $dependences = Dependence::customOrderBy($sorts)
            ->name($request->input('name'))
            ->paginate($request->per_page);

        return (new DependenceCollection($dependences))
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
    public function store(StoreDependenceRequest $request)
    {
        $dependence = new Dependence();

        $dependence->name = $request->input('name');
        $dependence->code = $request->input('code');
        $dependence->save();

        return (new DependenceResource($dependence))
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
    public function show(Dependence $dependence)
    {
        return (new dependenceResource($dependence))
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
    public function update(UpdateDependenceRequest $request, Dependence $dependence)
    {

        $dependence->name = $request->input('name');
        $dependence->code = $request->input('code');
        $dependence->save();

        return (new DependenceResource($dependence))
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
    public function destroy(Dependence $dependence)
    {
        $dependence->delete();
        return (new DependenceResource($dependence))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysDependenceRequest $request)
    {
        $dependence = Dependence::whereIn('id', $request->input('ids'))->get();
        Dependence::destroy($request->input('ids'));

        return (new DependenceCollection($dependence))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    //aprobar formularios solicitados
    // hacer un request de approved
    public function approvedApplication($request, Application $application){
        $state = State::firstWhere('code', 'ACEPTADO');
        $application->states()->attach($state);
        $dependence= Dependence::find($request->input('dependece.id'));

        return "formulario aprobado";
    }

    //rechazar formularios solicitados
    //hacer un request de refuse
    public function refuseApplication($request, Application $application){
        $state = State::firstWhere('code', 'RECHAZADO');
        $application->states()->attach($state);
        $dependence= Dependence::find($request->input('dependece.id'));

        return "formulario aprobado";
        // AGREGAR EL return estructurado
    }

    // asignar dependence
    // consultar tabla dependecia y tabla usaurio
    // crear la fk de carrera
    public function  assignDependence($request, Dependence $dependence){
        $user = User::find($request->input('user.id'));
        $dependence->users()->attach($user);

        return "dependecia asignada";
    }
}
