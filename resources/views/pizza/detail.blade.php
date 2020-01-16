@include('layouts.head')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('layouts.menu') 
            </div>
          
            <div class="content">
                <div class="title m-b-md">
                    {{ $pizza->name }}
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
                                        
                                            <h4>Ingredients {{ $pizza->name }}:</h4> 
                                            <ul class="ingredients">
                                            @foreach($pizza->ingredients as $ingredient)
                                               <li> {{ $ingredient['name'] }} - {{ $ingredient['price'] }} eur</li>
                                            @endforeach
                                            </ul>
                                            <h4>Total Price : {{ $pizza->total_price }} eur</h4>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </body>
    @include('layouts.footer')
    