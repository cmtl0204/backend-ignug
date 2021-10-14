<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;
use App\Models\JobBoard\Category;
use App\Http\Requests\V1\JobBoard\Category\StoreCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\IndexCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\UpdateCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\DestroysCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\GetAreasRequest;
use App\Http\Resources\V1\JobBoard\CategoryCollection;
use App\Http\Resources\V1\JobBoard\ProfessionalDegreeCollection;
use App\Http\Resources\V1\JobBoard\CategoryResource;
use App\Http\Resources\V1\JobBoard\AreaResource;

class CategoryController extends Controller
{
    function index(IndexCategoryRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $categories = Category::customOrderBy($sorts)
            ->code($request->input('code'))
            ->name($request->input('name'))
            ->paginate($request->per_page);

        return (new CategoryCollection($categories))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function getAreas(GetAreasRequest $request)
    {
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();

        return (new CategoryCollection($categories))
        ->additional([
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]
        ]);
    }

    function show(Category $category)
    {
        return (new CategoryResource($category))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function storeProfessionalDegree(StoreCategoryRequest $request)
    {
        $parent = Category::find($request->input('parent.id'));

        $category = new Category();
        $category->parent()->associate($parent);
        $category->code = $request->input('code');
        $category->name = $request->input('name');
        $category->icon = $request->input('icon');
        $category->save();

        return (new CategoryResource($category))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function storeArea(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->code = $request->input('code');
        $category->name = $request->input('name');
        $category->save();

        return (new CategoryResource($category))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function updateProfessionalDegree(UpdateCategoryRequest $request, Category $professionalDegree)
    {
        $parent = Category::find($request->input('parent.id'));
        
        $professionalDegree->parent()->associate($parent);
        $professionalDegree->code = $request->input('code');
        $professionalDegree->name = $request->input('name');
        $professionalDegree->icon = $request->input('icon');
        $professionalDegree->save();

        return (new CategoryResource($professionalDegree))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    function updateArea(UpdateCategoryRequest $request, Category $area)
    {
        $area->code = $request->input('code');
        $area->name = $request->input('name');
        $area->save();

        return (new AreaResource($area))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return (new CategoryResource($category))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysCategoryRequest $request)
    {
        $categories = Category::whereIn('id', $request->input('ids'))->get();
        Category::destroy($request->input('ids'));

        return (new CategoryCollection($categories))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function getProfessionalDegrees()
    {
        $professionalDegrees = Category::whereNotNull('parent_id')->orderBy('name')->get();

        return (new ProfessionalDegreeCollection($professionalDegrees))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }
}
