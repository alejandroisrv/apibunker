<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            })->whereNotIn('id', [11, 12, 13])->get();

        $items->map(function ($item) {
            $item->imagen = config('global.base_url') . 'assets/img/' . $item->imagen;
            $item->productos->map(function ($producto) {
                $producto->id = $producto->idproductos;
                $producto->imagen = config('global.base_url') . 'assets/img/productos/' . $producto->imagen;
                $producto->nombre_categoria = $producto->categoria->nombre;
                unset($producto->idproductos);
                unset($producto->categoria);
            });
        });

        return response()->json(['body' => $items]);
    }

    function toggleFavorito(Request $request)
    {


        $user = Auth::user();

        $producto = $request->producto;

        $user->favorites()->toggle([$producto]);


        return response()->json(['response' => 'ok']);
    }

    function addCart(Request $request)
    {

        $user = Auth::user();

        $producto = $request->producto;

        $user->cart()->detach($producto);
        $user->cart()->attach($producto, ['cantidad' => $request->cantidad]);

        return response()->json(['response' => 'ok']);
    }


    function getProducto(Request $request, $slug)
    {
        $producto = Producto::whereSlug($slug)->first();
        $producto->imagen = config('global.base_url') . 'assets/img/b/' . $producto->imagen;
        return response()->json($producto);
    }

    function getCategorias(Request $request)
    {
        $categorias = ProductoCategoria::select('id', 'nombre', 'imagen')
            ->whereNotIn('id', [11, 12, 13])
            ->get();

        $categorias->map(function ($item) {
            $item->imagen = config('global.base_url') . 'assets/img/' . $item->imagen;
            $item->productos = [];
        });

        return response()->json(['body' => $categorias]);
    }


    function getProductosFavoritos(Request $request)
    {

        $productos = Auth::user()->favorites()->select('idproductos', 'nombre', 'slug', 'categoria_id', 'imagen', 'descripcion', 'precionoche')->orderBy('fecha_creacion','DESC')->get();
        $productos->map(function ($producto) {
            $producto->id = $producto->idproductos;
            $producto->nombre_categoria = $producto->categoria->nombre;
            $producto->imagen = config('global.base_url') . 'assets/img/productos/' . $producto->imagen;
            unset($producto->idproductos);
            unset($producto->categoria);
        });
        return response()->json(['body' => $productos]);
    }

    function getProductosCart(Request $request)
    {
        $productos = Auth::user()->cart()->select('idproductos', 'nombre', 'slug', 'categoria_id', 'imagen', 'descripcion', 'precionoche')->orderBy('fecha_creacion','DESC')->get();

        $productos->map(function ($producto) {
            $producto->id = $producto->idproductos;
            $producto->nombre_categoria = $producto->categoria->nombre;
            $producto->imagen = config('global.base_url') . 'assets/img/productos/' . $producto->imagen;
            $producto->cantidad = $producto->pivot->cantidad;
            unset($producto->idproductos);
            unset($producto->categoria);
        });

        return response()->json(['body' => $productos]);
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
