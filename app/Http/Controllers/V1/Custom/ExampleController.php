<?php

namespace App\Http\Controllers\V1\Custom;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Custom\Example\DestroysCustomRequest;
use App\Http\Requests\V1\Custom\Example\IndexCustomRequest;
use App\Http\Requests\V1\Custom\Example\StoreCustomRequest;
use App\Http\Requests\V1\Custom\Example\UpdateCustomRequest;
use App\Http\Resources\V1\Custom\ExampleCollection;
use App\Http\Resources\V1\Custom\ExampleResource;
use App\Models\Custom\Example;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexCustomRequest $request
     * @return ExampleCollection
     */
    public function index(IndexCustomRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $examples = Example::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new ExampleCollection($examples))
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
     * @param  StoreCustomRequest $request
     * @return ExampleResource
     */
    public function store(StoreCustomRequest $request)
    {
        $example = new Example();
        $example->field_example = $request->input('fieldExample');
        $example->save();

        return (new ExampleResource($example))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Example $example
     * @return ExampleResource
     */
    public function show(Example $example)
    {
        return (new ExampleResource($example))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Example $example
     * @return ExampleResource
     */
    public function update(UpdateCustomRequest $request, Example $example)
    {
        $example->field_example = $request->input('fieldExample');
        $example->save();

        return (new ExampleResource($example))
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
     * @param  Example $example
     * @return ExampleResource
     */
    public function destroy(Example $example)
    {
        $example->delete();
        return (new ExampleResource($example))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysCustomRequest $request
     * @return ExampleCollection
     */
    public function destroys(DestroysCustomRequest $request)
    {
        $examples = Example::whereIn('id', $request->input('ids'))->get();
        Example::destroy($request->input('ids'));

        return (new ExampleCollection($examples))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
