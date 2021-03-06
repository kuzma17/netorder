<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contractor;
use App\Firm;
use App\Notifications\NewOrder;
use App\Order;
use App\Status;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Notification;

class OrderController extends Maincontroller
{
    private function get_order(){
        $user = \Auth::user();
        if($user->is_admin()){
            $orders = new Order();
            return $orders;
        }
        if($user->is_admin_firm()){
            $orders = Order::where('firm_id', $user->profile->firm_id);
            return $orders;
        }
        if($user->is_client()){
            $orders = Order::where('client_id', $user->profile->branch_id);
            return $orders;
        }
        if($user->is_contractor()){
            $orders = Order::where('contractor_id', $user->profile->contractor_id);
            return $orders;
        }
    }

    public function list($orders = [], $firm_id = '', $filter = false){
        if(!$filter) {
            $orders = $this->get_order()->orderBy('updated_at', 'desc')->paginate($this->setting->get_param('paginate'));
        }
        if($firm_id){
            $firmId = $firm_id;
        }else{
            $firmId = \Auth::user()->profile->firm_id;
        }
        $firms = Firm::where('status', 'on')->orderBy('name')->get();
        $contractors = Contractor::where('status', 'on')->orderBy('name')->get();
        $statuses = Status::all();
        $clients = Client::where('firm_id', $firmId)->get();

        $countAllOrder = $this->get_order()->count();
        $countWaitOrder = $this->get_order()->where('status_id', 1)->count();
        $countWorkOrder = $this->get_order()->whereIn('status_id', [2,3,4])->count();

        return view('order.list', [
            'orders' => $orders,
            'firms' => $firms,
            'clients' => $clients,
            'contractors' => $contractors,
            'statuses' => $statuses,
            'countAllOrder' => $countAllOrder,
            'countWaitOrder' => $countWaitOrder,
            'countWorkOrder' => $countWorkOrder,
            'setting'=>$this->setting
        ]);
    }

    public function view($id){
        $order = Order::find($id);
        $user = \Auth::user();
        return view('order.view', ['order'=>$order, 'user'=>$user, 'setting'=>$this->setting]);
    }

    public function filter(Request $request){

        //$orders = Order::when($request->date_from, function ($q, $date_from){
        $orders = $this->get_order()
            ->when($request->date_from, function ($q, $date_from){
            return $q->where('created_at', '>=', $date_from);
            })
            ->when($request->date_to, function ($q, $date_to){
                return $q->where('created_at', '<', $date_to);
            })
            ->when($request->firm, function ($q, $firm){
                return $q->where('firm_id', $firm);
            })
            ->when($request->branch, function ($q, $branch){
                return $q->where('client_id', $branch);
            })
            ->when($request->contractor, function ($q, $contractor){
                return $q->where('contractor_id', $contractor);
            })
            ->when($request->status, function ($q, $status){
                return $q->where('status_id', $status);
            })
            ->orderBy('updated_at', 'desc')->paginate(20);
        //return view('order.list', ['orders'=>$orders]);
        $filter = true;
        $firm_id = $request->firm;
        return $this->list($orders, $firm_id, $filter);
    }

    public function add(Request $request){

        $order = new Order();
        $user = \Auth::user();

        if(Gate::denies('add', $order)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $order->rules );

            $order->type_work_id = $request->type_work;
            $order->firm_id = $user->profile->firm_id;
            $order->client_id = $user->profile->branch_id;
            $order->user_id = $user->id;
            $order->contractor_id = $user->profile->client->contractor_id;
            $order->printer_id = isset($request->printer)? $request->printer: 0;
            $order->cartridge_id = isset($request->cartridge)? $request->cartridge: 0;
            $order->count_cartridge = isset($request->count_cartridge)? $request->count_cartridge: 0;
            $order->date_end = $request->date_end;
            $order->comment = $request->comment;
            $order->status_id = 1;
            $order->save();

            //foreach ($user->profile->client->contractor->userProfiles as $profile){
           //     echo $profile->user->email.'<br>';
           // }
            //Notification::send(User::all(), new NewOrder($order));


            $order->notify(new NewOrder($order));

            return redirect(route('orders'))->with('ok_message', 'Ваш заказ успешно создан и будет обработан в ближайшее время.');
        }

        return view('order.add', ['order'=>$order, 'user'=>$user, 'setting'=>$this->setting]);
    }

    public function edit(Request $request, $id){

        $order = Order::find($id);
        $user = \Auth::user();

        if(Gate::denies('edit', $order)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            if($user->is_client()) {

                $this->validate($request, $order->rules);

                //$order->type_work_id = $request->type_work;
                $order->date_end = $request->date_end;
                $order->printer_id = isset($request->printer) ? $request->printer : 0;
                if($request->type_work ==1 || $request->type_work ==2) {
                    $order->cartridge_id = isset($request->cartridge) ? $request->cartridge : 0;
                    $order->count_cartridge = isset($request->count_cartridge) ? $request->count_cartridge : 0;
                }else{
                    $order->cartridge_id = 0;
                    $order->count_cartridge = 0;
                }
                $order->comment = $request->comment;
            }
            $order->type_work_id = $request->type_work;
            $order->act_complete = isset($request->act_complete)?$request->act_complete: '';
            $order->agreement = isset($request->agreement)? $request->agreement: '';
            $order->status_id = isset($request->status)? $request->status: 1;
            $order->save();

            return redirect(route('orders'))->with('ok_message', 'Ваш заказ успешно изменен.');
        }

        return view('order.edit', ['order'=>$order, 'user'=>$user, 'setting'=>$this->setting]);
    }

    public function del($id){
        $order = Order::find($id);

        if(Gate::denies('del', $order)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $order->delete();
        return redirect(route('orders'))->with('info_message', 'Заказ успешно удален.');
    }
}
