<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Catalogues\IndexCatalogueRequest;
use App\Http\Resources\V1\Catalogues\CatalogueCollection;
use App\Models\Catalogue;

class CatalogueController extends Controller
{
    public function __construct()
    {
//        $this->middleware('role:admin')->only(['destroyTrashed']);
//
//        $this->middleware('permission:download-files')->only(['download']);
//        $this->middleware('permission:upload-files')->only(['upload']);
//        $this->middleware('permission:view-files')->only(['index', 'show']);
//        $this->middleware('permission:update-files')->only(['update']);
//        $this->middleware('permission:delete-files')->only(['destroy', 'destroys']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return CatalogueCollection
     */
    public function index(IndexCatalogueRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $catalogues = Catalogue::customOrderBy($sorts)
            ->type($request->input('type'))
            ->paginate();

        return (new CatalogueCollection($catalogues))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }
}
