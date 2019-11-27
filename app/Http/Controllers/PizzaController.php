<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display All Pizza Items.
     * 
     * @Author Mohamed Said.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::all();
        if($pizzas->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizzas' => $pizzas], 200); 
    }

    /**
     * Search And Display Pizza By Pizza Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $pizzaId Pizza Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function findPizzaById($pizzaId){
        $pizza = Pizza::where('id', $pizzaId)->get();
        if($pizza->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizza' => $pizza], 200); 
    }

    /**
     * Search And Display Pizza By Pizza Name.
     *
     * @Author Mohamed Said.
     * 
     * @param  string  $pizzaName Pizza Name.
     * 
     * @return \Illuminate\Http\Response
     */
    public function findPizzaByName($pizzaName){
        $pizza = Pizza::where('name', $pizzaName)->get();
        if($pizza->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizza' => $pizza], 200); 
    }

    /**
     * Search And Display Pizza By Pizza Category Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $pizzaCategory Pizza Category Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function findPizzaByCategoryId($pizzaCategory){
        $pizza = Pizza::where('category_id', $pizzaCategory)->get();
        if($pizza->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizza' => $pizza], 200); 
    }

    /**
     * Store A New Pizza Item In DB.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|min:3|max:50",
            "price" => "required|numeric",
            "category_id" => "nullable|exists:pizza_categories,id"
        ]);
        \DB::beginTransaction();
        $pizza = new Pizza();
        $pizza->fill($request->all());
        if(!$pizza->save())
            \DB::rollBack();
        \DB::commit();
        return response()->json(['pizza' => $pizza], 200); 
    }

    /**
     * Update Pizza Item Using It's Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $pizza  Pizza Item Object.
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {
        $this->validate($request, [
            "name" => "required|min:3|max:50",
            "price" => "required|numeric",
            "category_id" => "nullable|exists:pizza_categories,id"
        ]);
        \DB::beginTransaction();
        $pizza->fill($request->all());
        if(!$pizza->save())
            \DB::rollBack();
        \DB::commit();
        return response()->json(['pizza' => $pizza], 200); 
    }

    /**
     * Delete Pizza Item Using It's Id.
     *
     *  @Author Mohamed Said.
     * 
     * @param  int  $id Pizza Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($pizzaId)
    {
        try {
            $pizza = Pizza::find($pizzaId);
            if ($pizza->delete())
                return response()->json("Deleted", 200); 
        } catch (\Exception $exception) {
            return response()->json("Can't Delete Item", 500); 
        }
        return response()->json("Can't Delete Item", 500); 
    }

}
