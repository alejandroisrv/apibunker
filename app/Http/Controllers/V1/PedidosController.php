<?php


namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
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

            $productos = DB::table('clientes_carrito')
            ->selectRaw('id_producto as id,cantidad')
            ->where('id_cliente',$cliente->id)
            ->get();

            //PLUCK ESPECIAL ID => CANTIDAD 

            $pedidos = Pedido::create([
            'cliente_id' => $cliente->id ,
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'tipo_pago' => $data['metodo_pago'] ,
            'total' => $data['total'],
            'observaciones' => $data['adicional'],
            ]);

            foreach ($productos as $producto) {
                $pedidos->productos()->create([
                    'producto_id' => $producto->id,
                    'cantidad' => $producto->cantidad
                ]);
            }
            

            return response()->json(['response' => 'ok']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() ]);
        }
      

    }
}
