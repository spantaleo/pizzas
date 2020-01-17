<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Ingredient;

class IngredientController extends Controller
{

    public function index()
    {
		
		$ingredients = Ingredient::all();
		
       return view('ingredient.index', ['ingredients' => $ingredients]);
    }

    public function ingredientById($id){

        $ingredient = Ingredient::find($id); 
     
        $ingredient->price = $ingredient->price;

        return json_encode(array('success' => true, "error" => 0, "msg" => "OK" , 'ingredient' => $ingredient));
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
            'price'   => 'required',			
        );
		
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error in store" ));
        } else {
        
            try{
                  // store
                $ingredient = new Ingredient;
                $ingredient->name     = $request->name;
                $ingredient->description    = "";
                $ingredient->price    = $request->price;
                $ingredient->save();
            
                
            }catch(Exception $e){
                return json_encode(array("error" => 1, "msg" => $e->getMessage() ));    
            }
            			
            return json_encode(array('success' => true, "error" => 0, "msg" => "OK" ));
        }
    }


/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $rules = array(
            'name'   => 'required|min:5|max:50',
            'price'   => 'required',
            'id'   => 'required',			
        );
		
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return json_encode(array("error" => 1, "msg" => "Error in store" ));
        } else {
        
            try{
                  // update
                  Ingredient::where('id', $request->id)->update(['name' => $request->name, 'price' => $request->price]);
        
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
        $ingredient = Ingredient::find($id);
        $ingredient->delete();

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
