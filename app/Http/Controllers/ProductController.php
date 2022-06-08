<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function frontend(){
        return product::all();
    }
    public function backend(Request $request){
        $query=product::query();
        if($s=$request->input('S')){
            $query->where('title','regexp',"/$s/")
                ->orWhere('description','regexp',"/$s/");

        }
        return $query->get();
    }
}
