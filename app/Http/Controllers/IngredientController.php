<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return json_encode(array('success' => true, "error" => 0, "msg" => "OK" , 'ingredient' => $ingredient));
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
