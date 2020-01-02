<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Support\Facades\Request;

class PedidosController extends Controller
{

    function getPedidos(Request $request){

        $estado = $request->estado;

        $pedidos = Pedido::when($request->estado, function($q) use($estado){
            return $q->where('status',$estado);
        })
        ->orderBy('fecha_creacion','DESC')
        ->get();
    }

    function getMyPedidos(Request  $request ){

        $cliente_id = 10;
        $estado = $request->estado;

        $pedidos = Pedido::where('cliente_id', $cliente_id)->when($request->estado, function($q) use($estado){
            return $q->where('status',$estado);
        })
        ->orderBy('fecha_creacion','DESC')
        ->get();

        return response()->json($pedidos);
    }
}
