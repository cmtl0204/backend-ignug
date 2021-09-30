<?php

namespace App\Http\Controllers\V1\LicenseWork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LicenseWork\Holiday;
class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexHolidayRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $holidays = Holiday::customOrderBy($sorts)
            ->paginate($request->per_page);

        return (new HolidayCollection($holidays))
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
    public function store(StoreHolidayRequest $request)
    {
        $holiday = new Holiday();
        $holiday->employee()
            ->associate(Employee::find($request->input('employee.id')));

        $holiday->number_days = $request->input('numberDays');
        $holiday->year = $request->input('year');
        $holiday->save();

        return (new HolidayResource($holiday))
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
    public function show(Holiday $holiday)
    {
        return (new HolidayResource($holiday))
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
        $holiday->employee()
            ->associate(Employee::find($request->input('employee.id')));

        $holiday->number_days = $request->input('numberDays');
        $holiday->year = $request->input('year');
        $holiday->save();

        return (new HolidayResource($holiday))
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
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return (new HolidayResource($holiday))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    public function destroys(DestroysHolidayRequest $request)
    {
        $holidays = HolidayResource::whereIn('id', $request->input('ids'))->get();
        HolidayResource::destroy($request->input('ids'));

        return (new HolidayCollection($holidays))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
   
}
}
