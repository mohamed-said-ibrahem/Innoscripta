<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display All Orders.
     *
     * @Author Mohamed Said.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['pizzas.category','user'])->latest()->get();
        return response()->json($orders);
    }

    /**
     * Create New Pizza Order.
     *
     * @Author Mohamed Said.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $order = new Order([
            'total' => $request->get('total'),
            'address' => $request->get('address'),
            'user_id' => $request->get('user_id'),
          ]);
          if ($order->save())
             return response()->json(['id' => $order->id], 200); 
        return response()->json("Wrong Operation", 500);
     
        //test Validiation
         // $this->validate($request,[
        //     "name" => "required|min:2|max:50",
        //     "description" => "min:10|max:50"
        // ]);
        // $pizzaCategory = new PizzaCategory();
        // $pizzaCategory->fill($request->all());
        // if ($pizzaCategory->save())
        //     return response()->json(['id' => $pizzaCategory->id], 200); 
        // return response()->json("Wrong Operation", 500); 
         
    }

    /**
     * Store A New Order Item In DB.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $user = User::find($request->user_id);
            $order = new Order();
            $order->user()->associate($user);
            $order->total = 0;
            $order->address = $request->get('address' , $user->address);
            if ($order->save()) {
                $order->pizzas()->sync($request->pizzas);
                foreach ($order->pizzas as $pizza)
                    $order->total += $pizza->price;
                if ($order->save()) {
                    \DB::commit();
                    return response()->json('Done', 200); 
                }
            }
            \DB::rollBack();
            return response()->json("Wrong Operation", 500);
        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json("Wrong Operation", 500);
        }
    }
    
    /**
     * Return Order With Specified Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $orderId  Order Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function findOrderById($orderId){
        $order = Order::where('id', $orderId)->get();
        if($order->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['order' => $order], 200); 
    }

    /**
     * Return Order With Specified User Id 
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $userId  User Id
     * 
     * @return \Illuminate\Http\Response
     */
    public function findOrderByUserId($userId){
        $order = Order::where('user_id', $userId)->get();
        if($order->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['order' => $order], 200); 
    }
    
    /**
     * Update Order Item Inside DB.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $order Order Item Object.
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            "total" => "required|min:3|max:50",
            "address" => "required|numeric",
            "user_id" => "required|numeric"
        ]);
        \DB::beginTransaction();
        $order->fill($request->all());
        if(!$order->save())
            \DB::rollBack();
        \DB::commit();
        return response()->json(['order' => $order], 200); 
    }

   /**
     * Delete Order Item Using It's Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $id Order Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order->delete())
            return response()->json("Success!", 200); 
        return response()->json("Error!!", 500);
    }
    
}
