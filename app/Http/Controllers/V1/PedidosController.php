<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
    }

    function getMyPedidos(Request $request)
    {

        $cliente_id = Auth::user()->id;
        $estado = $request->estado;

        $pedidos = Pedido::where('cliente_id', $cliente_id)
            ->when($request->estado, function ($q) use ($estado) {
                return $q->where('status', $estado);
            })
            ->orderBy('fecha_creacion', 'DESC')
            ->get();

        return response()->json($pedidos);
    }

    function nuevoPedido(Request $request){

        try {

              $cliente = Auth::user();
              $data = $request->all();

              $monto = 100;

              $productos = $cliente->cart()->get();

              //PLUCK ESPECIAL ID => CANTIDAD 

              $pedidos = Pedido::create([
                'cliente_id' => $cliente->id ,
                'direccion' => $cliente->direccion,
                'referencia' => $data['referencia'],
                'telefono' => $data['telefono'],
                'pago' => $data['pago'] ,
                'monto' => $monto,
              ]);

              $pedidos->productos()->sync($productos);


            return response()->json(['response' => 'ok']);

        } catch (\Exception $th) {
            //throw $th;
        }
      

    }
}
