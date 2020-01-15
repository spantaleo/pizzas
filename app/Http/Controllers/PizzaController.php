<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pizza;
use App\IngredientsPizza;
use App\Ingredient;


class PizzaController extends Controller
{
    
    public function index()
    {
        //$pizzas = DB::table('pizzas')->get();
		
		$pizzas = Pizza::all();
		
       return view('pizza.index', ['pizzas' => $pizzas]);
    }
	
	
	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$pizza = Pizza::find($id);
        
        $ingredients_pizza = IngredientsPizza::where('id_pizza', $id)->get();

        $ingredients = [];
        $total_price = 0;
        foreach($ingredients_pizza as $key => $ingredient_pizza){
            $ingredient = Ingredient::find($ingredient_pizza->id_ingredient);            
            $ingredients[$key]['name'] = $ingredient['name']; 
            $ingredients[$key]['price'] = $ingredient['price']; 
            $total_price = $total_price + $ingredient['price'];
        }
        

        $plus =  $total_price / 2;
        $pizza->ingredients = $ingredients;
       // $pizza->total_price = $total_price + ( $total_price / 2);

       $pizza->total_price = $total_price + $plus;

        //var_dump($pizza->ingredients);
        //die();

        return view('pizza.detail', ['pizza' => $pizza]);
    }
	
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name'   => 'required',			
        );
		
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error en la validacion para guardar" ));
        } else {
            // store
            $pizza = new Pizza;
            $pizza->name     = $request->name;
            $pizza->save();
			
			
			$ingredient_pizza = new IngredientsPizza;
			$ingredient_pizza->id_pizza      = $request->ingredient;
            $ingredient_pizza->id_ingredient = $request->ingredient;
            $pizza->save();

            return json_encode(array("error" => 0, "msg" => "OK" ));
        }

    }
	
	/**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
	
}
