<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    // master page (.../shop)
    public function index(){
        return view("shop.index");
    }
    // details page (.../shop/{id})
    public function show($id){
        // goes to page and sends id to the view
        return view("shop.show", ["id" => $id]);
    }
}
