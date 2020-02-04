<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class PedidosController extends Controller
{

    function getPedidos(Request $request)
    {

        $estado = $request->estado;

        $pedidos = Pedido::when($request->estado, function ($q) use ($estado) {
            return $q->where('status', $estado);
        })
            ->orderBy('fecha_creacion', 'DESC')
            ->get();

        return response()->json($pedidos);
    }


    function changeStatePedido(Request $request, $pedido)
    {

        $estado = $request->estado;

        $pedido = Pedido::find($pedido);

        $pedido->update(['estado' => $estado]);

        $mensaje = $estado == 1 ? 'Tu pedido esta en camino' : 'Tu pedido ha sido entregado';

        Notifications::create([
            'cliente_id' => $pedido->cliente_id,
            'tipo' => 2,
            'contenido' => $mensaje,
        ]);

        return response()->json(['response' => 'ok', 'item' => $pedido]);
    }
}
