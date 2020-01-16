<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Pizza;
use App\IngredientsPizza;
use App\Ingredient;


class PizzaController extends Controller
{
    
    public function index()
    {
        
       $pizzas = Pizza::all();		
       $ingredients = Ingredient::all();     

       return view('pizza.index', ['pizzas' => $pizzas, 'ingredients' => $ingredients]);
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
        
        $pizza->ingredients = $ingredients;

        // plus 50% of the total for the preparation.
        $plus =  $total_price / 2;
        $pizza->total_price = $total_price + $plus;
        
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
            'name'   => 'required|min:5|max:50',			
        );
		
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error in store" ));
        } else {
        

            try{
                  // store
                $pizza = new Pizza;
                $pizza->name     = $request->name;
                $pizza->description     = $request->description;
                $pizza->save();
            
                foreach( $request->ingredients as $ingredientId ){
                    $ingredient_pizza = new IngredientsPizza;
                    $ingredient_pizza->id_pizza      = $pizza->id;
                    $ingredient_pizza->id_ingredient = $ingredientId;
                    $ingredient_pizza->save();
                }
  

            }catch(Exception $e){
                return json_encode(array("error" => 1, "msg" => $e->getMessage() ));    
            }
            			
            return json_encode(array('success' => true, "error" => 0, "msg" => "OK" ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // delete
        $pizza = Pizza::find($id);
        $pizza->delete();

    }

    public function pizzaById($id)
    {
        try{
            $pizza = Pizza::find($id);
            $ingredients_pizza = IngredientsPizza::where('id_pizza', $id)->get();

            $ingredients = [];
            foreach($ingredients_pizza as $key => $ingredient_pizza){
                $ingredient = Ingredient::find($ingredient_pizza->id_ingredient);            
                $ingredients[$key] = $ingredient['id']; 
            }
            $pizza->ingredients = $ingredients;
        
        }catch(Exception $e){
            return json_encode(array( "error" => 1, "msg" => $e->getMessage() ));    
        }    

        return json_encode(array('success' => true, "error" => 0, "msg" => "OK" , 'pizza' => $pizza));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request)
    {
         
        // validate
        $rules = array(
            'name'   => 'required|string|min:5|max:50',
            'id'   => 'required|int'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error in update" ));
        } else {
        
            try{

                // store
                $pizza = Pizza::find($request->id);
                Pizza::where('id', $request->id)->update(['name' => $request->name, 'description' => $request->description]);
        
                IngredientsPizza::where('id_pizza', $request->id)->delete();
        
                foreach( $request->ingredients as $ingredientId ){
                    $ingredient_pizza = new IngredientsPizza;
                    $ingredient_pizza->id_pizza      = $request->id;
                    $ingredient_pizza->id_ingredient = $ingredientId;
                    $ingredient_pizza->save();
                }
                
                return json_encode(array('success' => true, "error" => 0, "msg" => "OK" ));
            
            }catch(Exception $e){
                return json_encode(array('success' => false, "error" => 1, "msg" => $e->getMessage() ));    
            }    
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
