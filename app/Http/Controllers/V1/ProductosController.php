<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    function getProductos(Request $request)
    {

        $categoria = $request->categoria;
        $search = $request->buscar;

        $productos = ProductoCategoria::with('productos')->when($request->categoria, function ($q) use ($categoria) {
            return $q->where('id', $categoria);
        })->when($request->buscar, function ($q) use ($search) {
            return $q->whereHas('productos', function ($q) use ($search) {
                return $q->where('nombre', 'like', '%' . $search . '%');
            });
        })->get();
        
        return response()->json($productos);
    }

    function getProducto(Request $request, $slug)
    {
        $producto = Producto::with('categoria')->whereSlug($slug)->first();
        return response()->json($producto);
    }

    function getCategorias(Request $request)
    {
        $categorias = ProductoCategoria::all();
        return response()->json($categorias);
    }
}
