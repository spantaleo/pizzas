    @extends('layouts.head') 

        <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/getPizzas') }}">Pizzas</a>
                <a href="{{ url('/getIngredients') }}">Ingredients</a> 
            </div>       
            <div class="content">
                <div class="title m-b-md">
                    Ingredients
                </div>

                <div class="links">
				 
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(isset($success))
                                <div class="alert alert-success">
                                    {{ $success }}
                                </div>
                            @endif

                            <div class="portlet box blue">
                                
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Nro</th> 
                                                <th>Nombre</th>
                                                <th>Price</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ingredients as $ingredient)
                                                <tr>
                                                    <td>
                                                        {{ $ingredient->id }}
                                                    </td>
                                                    <td>
                                                        <i class="fa fa-star"></i>
                                                        {{ $ingredient->name }}
                                                    </td>
                                                    <td>
                                                        {{ $ingredient->price }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('ingredient/'.$ingredient->id) }}" class="btn btn-outline btn-circle green btn-sm purple">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </td>
                                                    <td>

                                                        <a href="{{ url('ingredient/'.$ingredient->id) }}" class="btn btn-outline btn-circle dark btn-sm black" onclick="return confirm('¿Está seguro que desea eliminar este elemento?')">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
                                                    </td>
                                                                                

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                        <a href="{{ url('ingredient/'.$ingredient->id) }}" class="btn btn-outline btn-circle green btn-sm purple">
                                                            <i class="fa fa-plus"></i> Add Ingredient </a>

                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </body>
    @extends('layouts.footer')
