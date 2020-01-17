<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;


Route::get('/', function () {
    return view('welcome');
});


//Pizza
Route::get('getPizza/{id}', 'PizzaController@show');
Route::get('getPizzas', 'PizzaController@index');
Route::post('addPizza', 'PizzaController@store');
Route::post('updatePizza', 'PizzaController@update');
Route::delete('delPizza/{id}', 'PizzaController@destroy');
Route::get('pizzaById/{nombre}', 'PizzaController@pizzaById');



//Ingredient
Route::get('getIngredient/{id}', 'IngredientController@show');
Route::get('getIngredients', 'IngredientController@index');
Route::post('addIngredient', 'IngredientController@store');
Route::post('updateIngredient', 'IngredientController@update');
Route::delete('delIngredient/{id}', 'IngredientController@destroy');
Route::get('findIngredient/{nombre}', 'IngredientController@search');
Route::get('ingredientById/{nombre}', 'IngredientController@ingredientById');