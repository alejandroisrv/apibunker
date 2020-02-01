<?php

/**
 * Created by PhpStorm.
 * User: EDWARD OSORIO
 * Date: 30/09/2019
 * Time: 4:40 PM
 */

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\Pedido;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class ClientesController extends Controller
{

    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = app('hash')->make($data['password']);
        return User::create($data);
    }


    function getMyProfile(Request $request)
    {

        $user = Auth::user();

        return response()->json(['body' => $user]);
    }

    function updateUser(Request $request)
    {

        $user = Auth::user();

        $data = $request->all();

        try {

            $user->nombre = $data['nombre'];
            $user->direccion = $data['direccion'];
            $user->telefono = $data['telefono'];

            isset($data['password']) ? $user->password = app('hash')->make($data['password']) : $user->password;

            $user->save();
            return response()->json(['response' => 'ok']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    function setReadNotificaciones(Request $request)
    {

        $cliente_id = Auth::user()->id;
        Notifications::where('cliente_id', $cliente_id)->update(['estado' => 1]);

        return response()->json(['response' => 'ok']);
    }

    function getNotificaciones(Request $request)
    {

        $cliente_id = Auth::user()->id;

        $notificaciones = Notifications::where('cliente_id', $cliente_id)->orderBy('fecha_creacion', 'DESC')->get();

        return response()->json(['body' => $notificaciones]);
    }

    function getMyPedidos(Request $request)
    {

        $cliente= Auth::user();
        $estado = $request->estado;

        $pedidos = $cliente->pedidos()
            ->when($request->estado, function ($q) use ($estado) {
                return $q->where('status', $estado);
            })
            ->orderBy('fecha_creacion', 'DESC')
            ->get();

        return response()->json(['body' => $pedidos]);
    }

    function nuevoPedido(Request $request)
    {

        try {

            $cliente = Auth::user();

            $data = $request->all();

            $productos = DB::table('clientes_carrito')
                ->selectRaw('id_producto as id,cantidad')
                ->where('id_cliente', $cliente->id)
                ->get();

            $pedidos = Pedido::create([
                'cliente_id' => $cliente->id,
                'direccion' => $data['direccion'],
                'latitud' => @$data['latitud'],
                'longitud' => @$data['longitud'],
                'telefono' => $data['telefono'],
                'tipo_pago' => $data['metodo_pago'],
                'total' => $data['total'],
                'observaciones' => @$data['adicional'],
                'fecha_creacion' => date('d/m/yy h:i:s'),
            ]);

            foreach ($productos as $producto) {
                $pedidos->productos()->create([
                    'producto_id' => $producto->id,
                    'cantidad' => $producto->cantidad
                ]);
            }

            Notifications::create([
                'cliente_id' => $cliente->id,
                'tipo' => 1,
                'contenido' => "Su pedido ha sido recibido",
                'fecha_creacion' => date('d/m/yy h:i:s'),
            ]);

            $cliente->cart()->detach();

            return response()->json(['response' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
