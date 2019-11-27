<?php

namespace App\Http\Controllers;

use App\PizzaCategory;
use Illuminate\Http\Request;

class PizzaCategoryController extends Controller
{
    
    /**
     * Display All Pizza Categories.
     *
     * @Author Mohamed Said.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzaCategories = PizzaCategory::all();
        if($pizzaCategories->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizzaCategories' => $pizzaCategories], 200); 
    }

    /**
     * Search And Display Pizza Ctegories By Category Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $categorieId Category Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchByCategoryId($categorieId)
    {
        $pizzaCategorie = PizzaCategory::where('id', $categorieId)->get();
        if($pizzaCategorie->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizzaCategorie' => $pizzaCategorie], 200);
    }

    /**
     * Search And Display Pizza Ctegories By Category Name.
     *
     * @Author Mohamed Said.
     * 
     * @param  string  $categorieName Pizza Category Name.
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchByCategoryName($categorieName)
    {
        $pizzaCategorie = PizzaCategory::where('name', $categorieName)->get();
        if($pizzaCategorie->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['pizzaCategorie' => $pizzaCategorie], 200);
    }

    /**
     * Store A New Pizza Category Item In DB.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => "required|min:2|max:50",
            "description" => "min:10|max:50"
        ]);
        $pizzaCategory = new PizzaCategory();
        $pizzaCategory->fill($request->all());
        if ($pizzaCategory->save())
            return response()->json(['id' => $pizzaCategory->id], 200); 
        return response()->json("Wrong Operation", 500); 
    }

    /**
     * Update Pizza Category Item Using It's Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id Category Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "name" => "required|min:2|max:50"
        ]);
        $category = PizzaCategory::find($id);
        $category->fill($request->all());
        if ($category->save())
            return response()->json("Success!", 200); 
        return response()->json("Error!!", 500); 
    }

    /**
     * Delete Pizza Category Item Using It's Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int $id Category Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = PizzaCategory::find($id);
        if ($category->delete())
            return response()->json("Success!", 200); 
        return response()->json("Error!!", 500);
    }

}
