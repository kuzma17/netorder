<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menu_items = [
        '/'=>'Заказы',
        'firms'=>'Организации'
        ];

    public function __construct()
    {
        return view('layouts.menu', ['menus' =>$this->menu_items]);

    }
}
