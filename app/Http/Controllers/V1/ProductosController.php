<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Producto;
<<<<<<< HEAD
=======
use App\Models\ProductoCategoria;
use Illuminate\Support\Facades\Request;
>>>>>>> 17f690ad6db077ee8a0f88aed4040a0432887d6a

class ProductosController extends Controller
{
    function getProductos(Request $request){

<<<<<<< HEAD
        function getProductos(Request $request){


            $categoria = $request->categoria;

            $productos = Producto::with(['categoria'])
                ->when($request->categoria, function($q) use ($categoria) {
                    return $q->where('categoria_id',$categoria);
                })->get();

            return response()->json($productos);
        }



=======
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
>>>>>>> 17f690ad6db077ee8a0f88aed4040a0432887d6a
}
