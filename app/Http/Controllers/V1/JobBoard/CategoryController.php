<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;
use App\Models\App\Catalogue;
use App\Models\JobBoard\Category;
use App\Http\Requests\V1\JobBoard\Category\StoreCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\IndexCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\UpdateCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\DestroysCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\GetParentCategoryRequest;
use App\Http\Resources\V1\JobBoard\CategoryCollection;
use App\Http\Resources\V1\JobBoard\CategoryResource;

class CategoryController extends Controller
{

    function index(IndexCategoryRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $categories = Category::customOrderBy($sorts)
            ->code($request->input('code'))
            ->name($request->input('name'))
            ->icon($request->input('icon'))
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

    function getParentCategories(GetParentCategoryRequest $request)
    {
        $categories = Category::whereNull('parent_id')->get();

        if ($categories->count() === 0) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'No se encontraron Categorías',
                    'detail' => 'Intente de nuevo',
                    'code' => '404'
                ]
            ], 404);
        }

        return response()->json([
            'data' => $categories,
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]
        ], 200);
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

    function store(StoreCategoryRequest $request)
    {
        $parent = Category::find($request->input('parent.id'));


        $category = new Category();
        $category->code = $request->input('code');
        $category->name = $request->input('name');
        $category->icon = $request->input('icon');
        $category->parent()->associate($parent);
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

    function update(UpdateCategoryRequest $request, Category $category)
    {
        $parent = Category::find($request->input('parent.id'));

        $category->parent()->associate($parent);
        $category->code = $request->input('code');
        $category->name = $request->input('name');
        $category->icon = $request->input('icon');
        $category->save();

        return (new CategoryResource($category))
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
}
