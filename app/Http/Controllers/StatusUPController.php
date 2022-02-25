<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class StatusUPController extends Controller
{
    public function update($id){
        $product = Product::find($id);
        if($product->status_product == 1){
           $product->status_product == 0;
        }else{
            $product->status_product == 1;
        }
        $product->save();
    }

}
