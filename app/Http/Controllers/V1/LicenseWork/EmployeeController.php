<?php

namespace App\Http\Controllers\V1\LicenseWork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LicenseWork\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(IndexEmployeeRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $employees = Reason::customOrderBy($sorts)
            ->paginate($request->per_page);

        return (new EmployeeCollection($reasons))
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

    public function store(StoreEmployeeRequest $request)
    {
         $employee = new Employee();
         $employee->users()
            ->associate(Users::find($request->input('users.id')));
         $employee->save();

        return (new EmployeeResource($employee))
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
    public function show(Employee $employee)
    {
        return (new EmployeeResource($employee))
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
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
         
         $employee->users()
            ->associate(Users::find($request->input('users.id')));
         $employee->save();

         return (new EmployeeResource($employee))
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
    
    
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return (new employeeResource($emplopyee))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysEmployeeRequest $request)
    {
        $employee = EmployeeResource::whereIn('id', $request->input('ids'))->get();
        EmployeeResource::destroy($request->input('ids'));

        return (new EmployeeCollection($employees))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
   
}





}
