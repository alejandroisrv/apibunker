<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Producto;

class ProductosController extends Controller
{

        function getProductos(Request $request){


            $categoria = $request->categoria;

            $productos = Producto::with(['categoria'])
                ->when($request->categoria, function($q) use ($categoria) {
                    return $q->where('categoria_id',$categoria);
                })->get();

            return response()->json($productos);
        }



}
