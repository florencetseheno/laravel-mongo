<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\Numeric_;

class ProductController extends Controller
{
    public function frontend(){
        return product::all();
    }
    public function backend(Request $request){
        $query=product::query();

        if($s=$request->input('s')){
            $query->where('title','regexp',"/.*$s/i")
                ->orWhere('description','regexp',"/.*$s/i");

        }
        if($sort=$request->input('sort')){

            $query->orderBy('price',$sort);
        }
        $perPage =9;
        $page=$request->input('page',1);
        $result=$query->offset(($page-1)*$perPage)->limit($perPage)->get();
        $total=$query->count();


        return[
            'data'=>$result,
            'total'=>$total,
            'page'=>$page,
            'last_page'=>ceil($total/$perPage)
        ];
    }

    /**
     * store new product
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        return product::create($request->all());
    }



        /**
     * delete product
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        return product::destroy($id);
    }

   /**
     * update product
     * @param string $id
   * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $product = product::where('_id', '=', $id)->first();
        $product->update($request->all());
        return $request;
    }


}
