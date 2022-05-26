<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Menu;
use App\Model\ShopSalePoint;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getPage(Request $request)
    {
        $menus = Menu::all();
        return view('page', [
            'title'=> $menus->filter(function($menu) use ($request) {
                return $menu->link === $request->path();
            })->first()->title,
            'menu' => $menus,
            'salePoints' => ShopSalePoint::orderBy("sort")->get(),
            'brands' => Brand::orderBy("sort")->get(),
            'categories' => Category::getTreeCategories(),
        ]);
    }
}
