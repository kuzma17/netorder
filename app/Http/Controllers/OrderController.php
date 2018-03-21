<?php

namespace App\Http\Controllers;

use App\Order;
use Gate;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list_order(){
        $orders = Order::orderBy('updated_at', 'desc')->paginate(20);
        return view('order.list', ['orders'=>$orders]);
    }

    public function add_order(Request $request){

        $order = new Order();

        if(Gate::denies('add', $order)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

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

            return redirect(route('orders'))->with('ok_message', 'Ваш заказ успешно создан и будет обработан в ближайшее время.');
        }

        return view('order.add', ['order'=>$order]);
    }

    public function edit_order(Request $request, $id){

        $order = Order::find($id);

        if(Gate::denies('edit', $order)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $order->rules);

            $order->type_work_id = $request->type_work;
            $order->date_end = $request->date_end;
            $order->comment = $request->comment;
            $order->status_id = $request->status;
            $order->save();

            return redirect(route('orders'))->with('ok_message', 'Ваш заказ успешно изменен.');
        }

        return view('order.edit', ['order'=>$order]);
    }

    public function del_order($id){
        $order = Order::find($id);

        if(Gate::denies('del', $order)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $order->delete();
        return redirect(route('orders'))->with('info_message', 'Ваш заказ успешно удален.');
    }
}
