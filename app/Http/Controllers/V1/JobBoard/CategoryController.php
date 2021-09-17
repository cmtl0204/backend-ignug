<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;
use App\Models\App\Catalogue;
use App\Models\JobBoard\Category;
use App\Http\Requests\JobBoard\Category\StoreCategoryRequest;
use App\Http\Requests\V1\JobBoard\Category\IndexCategoryRequest;
use App\Http\Requests\JobBoard\Category\UpdateCategoryRequest;
use App\Http\Requests\JobBoard\Category\DestroysCategoryRequest;
use App\Http\Requests\JobBoard\Category\GetParentCategoryRequest;
use App\Http\Resources\V1\JobBoard\CategoryCollection;
use App\Http\Resources\V1\JobBoard\CategoryResource;

class CategoryController extends Controller
{

    function index(IndexCategoryRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $categories = Category::customOrderBy($sorts)
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
        $parent = Category::find($request->input('category.parent.id'));


        $category = new Category();
        $category->code = $request->input('category.code');
        $category->name = $request->input('category.name');
        $category->icon = $request->input('category.icon');
        if ($parent) {
            $category->parent()->associate($parent);
        }
        $category->save();
        return response()->json([
            'data' => $category,
            'msg' => [
                'summary' => 'Categoria creada',
                'detail' => 'El registro fue creado',
                'code' => '201'
            ]
        ], 201);
    }

    function update(UpdateCategoryRequest $request, Category $category)
    {
        $parent = Category::find($request->input('category.parent.id'));

        $category->code = $request->input('category.code');
        $category->name = $request->input('category.name');
        $category->icon = $request->input('category.icon');
        if ($parent) {
            $category->parent()->associate($parent);
        }
        $category->save();

        return response()->json([
            'data' => $category,
            'msg' => [
                'summary' => 'Categoria actualizada',
                'detail' => 'El registro fue actualizado',
                'code' => '201'
            ]
        ], 201);
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
