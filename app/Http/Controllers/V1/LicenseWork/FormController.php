<?php

namespace App\Http\Controllers\V1\LicenseWork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LicenseWork\From;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexFromRequest $request)
    {
        $sorts = explode(',', $request->sort);
                
        $froms = From::customOrderBy($sorts)
            ->paginate($request->per_page)
            ->code($request->input('code'))
            ->regime($request->input('regime'))
            ->orderBy($request->input('orderBy'));



        return (new FromCollection($froms))
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
    public function store(StoreFormRequest $request)
    {
        $form = new Form();
        $form->employer()
            ->associate(Employer::find($request->input('employer.id')));
        

        $form->code= $request->input('code');
        $form->description= $request->input('description');
        $form->regime= $request->input('regime');
        $form->days_const= $request->input('daysConst');
        $form->approved_level= $request->input('approvedLevel');
        $form->state= $request->input('state');

        $form->save();

        return (new FormResource($form))
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
    public function show(Form $form)
    {
        return (new FormResource($form))
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
    public function update(UpdateApplicationRequest $request, Application $application)
    {
       
        $form->employer()
            ->associate(Employer::find($request->input('employer.id')));
        

        $form->code= $request->input('code');
        $form->description= $request->input('description');
        $form->regime= $request->input('regime');
        $form->days_const= $request->input('daysConst');
        $form->approved_level= $request->input('approvedLevel');
        $form->state= $request->input('state');

        $form->save();

        return (new FormResource($form))
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
    public function destroy(Form $form)
    {
        $form->delete();
        return (new FormResource($form))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    public function destroys(DestroysFormRequest $request)
    {
        $forms = FormResource::whereIn('id', $request->input('ids'))->get();
        FormResource::destroy($request->input('ids'));

        return (new FormCollection($forms))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
   
}
}
