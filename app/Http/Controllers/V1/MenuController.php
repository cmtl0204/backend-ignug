<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Authentications\MenuCollection;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(){
        return new MenuCollection(Menu::whereNull('parent_id')->get());
    }
}
