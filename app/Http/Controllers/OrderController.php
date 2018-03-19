<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use App\TypeWork;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function list_order(){
        $orders = Order::orderBy('updated_at', 'desc')->paginate(1);
        return view('order.list', ['orders'=>$orders]);
    }

    public function add_order(Request $request){

        $order = new Order();

        if($request->isMethod('post')){

            $this->validate($request, $order->rules );

            $order->type_work_id = $request->type_work;
            $order->client_id = \Auth::user()->client->id;
            $order->user_id = \Auth::id();
            $order->contractor_id = $request->contractor;
            $order->date_end = $request->date_end;
            $order->comment = $request->comment;
            $order->status_id = $request->status;
            $order->save();

            Session::flash('ok_message', 'Ваш заказ успешно создан и будет обработан в ближайшее время.');

            return redirect(route('orders'));
        }

        return view('order.add', ['order'=>$order]);
    }

    public function edit_order(Request $request, $id){

        $order = Order::find($id);

        if($request->isMethod('post')){

            $this->validate($request, $order->rules);

            $order->type_work_id = $request->type_work;
            $order->date_end = $request->date_end;
            $order->comment = $request->comment;
            $order->status_id = $request->status;
            $order->save();

            Session::flash('ok_message', 'Ваш заказ успешно создан и будет обработан в ближайшее время.');

            return redirect(route('orders'));
        }

        return view('order.edit', ['order'=>$order]);
    }

    public function del_order($id){
        $order = Order::find($id);
        $order->delete();
        return redirect(route('orders'));
    }
}
