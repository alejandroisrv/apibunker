<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function _\trimEnd;

class ProductosController extends Controller
{
    function getProductos(Request $request)
    {

        $categoria = $request->categoria;
        $search = $request->buscar;

        $items = ProductoCategoria::select('id', 'nombre', 'imagen')->with(['productos' => function ($q) {
            return $q->select('idproductos', 'nombre', 'slug', 'categoria_id', 'imagen', 'descripcion', 'precionoche')->get();
        }])
            ->when($request->categoria, function ($q) use ($categoria) {
                return $q->where('id', $categoria);
            })->when($request->buscar, function ($q) use ($search) {
                return $q->whereHas('productos', function ($q) use ($search) {
                    return $q->where('nombre', 'like', '%' . $search . '%');
                });
            })->whereNotIn('id', [12, 13, 15])->get();

        $items->map(function ($item) {
            $item->imagen = config('global.base_url') . 'assets/img/' . $item->imagen;
            $item->productos->map(function ($producto) {
                $producto->id = $producto->idproductos;
                $producto->imagen = config('global.base_url') . 'assets/img/productos/' . $producto->imagen;
                unset($producto->idproductos);
            });
        });

        return response()->json(['categorias' => $items]);
    }

    function toggleFavorito(Request $request, $slug)
    {


        
    }

    function getProducto(Request $request, $slug)
    {
        $producto = Producto::whereSlug($slug)->first();
        $producto->imagen = config('global.base_url') . 'assets/img/b/' . $producto->imagen;
        return response()->json($producto);
    }

    function getCategorias(Request $request)
    {
        $categorias = ProductoCategoria::select('id', 'nombre', 'imagen')->whereNotIn('id', [12, 13, 15])->get();

        $categorias->map(function ($item) {
            $item->imagen = config('global.base_url') . 'assets/img/' . $item->imagen;
            $item->productos = [];
        });

        return response()->json(['categorias'=> $categorias]);
    }

    function migrationCategorias(Request $request)
    {

        DB::beginTransaction();

        $productos = Producto::all();

        $productos->map(function ($item) {
            $slug = str_slug($item->nombre);
            $exists = Producto::where('slug', $slug)->exists();
            $item->slug = $exists ? str_slug($item->nombre . str_random(1)) : $slug;
            $item->save();
        });


        DB::commit();
    }
}
