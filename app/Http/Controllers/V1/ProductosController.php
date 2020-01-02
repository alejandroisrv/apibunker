<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use Illuminate\Support\Facades\Request;

class ProductosController extends Controller
{
    function getProductos(Request $request){

        $categoria = $request->categoria;

        $productos = Producto::with('categoria')->when($request->categoria, function($q) use($categoria){
            return $q->where('categoria_id',$categoria);
        })->get(10);
        
        return response()->json($categoria);
    }

    function getProducto(Request $request){

        $id = $request->id;
        $producto = Producto::with('categoria')->whereSlug($id)->first();

        return response()->json($producto);
    }


    function getCategorias(Request $request){

        $categorias = ProductoCategoria::all();
        return response()->json($categorias);
    }
}
