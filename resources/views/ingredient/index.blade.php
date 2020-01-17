    @include('layouts.head') 

        <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('layouts.menu') 
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
                                                            <button type="button" class="btn btn-info " id="ajaxEdit" onclick="editIngredient({{ $ingredient->id }});"><i class="fa fa-edit"></i> Edit</button>
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-danger" id="ajaxDelete" onclick="deleteIngredient({{ $ingredient->id }});"><i class="fa fa-trash-o"></i> Delete</button>
                                                        
                                                    </td>
                                                                                

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                         <!-- Trigger the modal with a button -->
                                         <button type="button" class="btn btn-info btn-sd" data-toggle="modal" onclick="clearIngredient();" data-target="#myModal" id="open">Add Ingredient</button>

                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
 


  <!-- MODDAL -->

  <div class="container">
            
            <form method="post" action="{{ url('addIngredient') }} id="form">
                    @csrf
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">
                    
                    <h5 class="modal-title">New Ingredient</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-10">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" maxlength="50" required>
                        <input type="hidden" class="form-control" name="id" id="id" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="Description">Price:</label>
                            <input type="text" class="form-control" name="price" maxlength="10" id="price">
                        </div>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>
                    </div>
                </div>
            </div>
            </div>
            </form>
        </div>
        <!-- /Attachment Modal -->

        <script>

            function clearIngredient(){
                jQuery('#id').val("");
                jQuery('#name').val("");
                jQuery('#price').val("");
            }

            function deleteIngredient(id){

                if(!confirm('Are you sure you want to delete this item?'))
                    return false;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/delIngredient') }}/" + id,
                    method: 'delete',
                    data: {
                        id: id,
                        _token: jQuery('[name="_token"]').val(),  
                    },
                    success: function(result){
                        if(result.errors)
                        {
                            jQuery('.alert-danger').html('');

                            jQuery.each(result.errors, function(key, value){
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            jQuery('.alert-danger').hide();
                            $('#open').hide();
                            $('#myModal').modal('hide');
                            location.reload();
                        }
                }});
            }


            function editIngredient(id){
                jQuery.ajax({
                        url: "{{ url('/ingredientById') }}/"+id,
                        method: 'get',
                        data: {
                            id: id,
                            _token: jQuery('[name="_token"]').val(),  
                        },
                        success: function(result){
                            if(result.errors)
                            {
                                jQuery('.alert-danger').html('');

                                jQuery.each(result.errors, function(key, value){
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<li>'+value+'</li>');
                                });
                            }
                            else
                            {
                                var obj = JSON.parse(result);
                        
                                jQuery('#id').val(obj.ingredient.id);
                                jQuery('#name').val(obj.ingredient.name);
                                jQuery('#price').val(obj.ingredient.price);

                                $('#myModal').modal('show');
                            }
                        }
                    });
            }
            </script>
            <script>
            $(document).ready(function(){
                jQuery('#ajaxSubmit').click(function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    jQuery.ajax({
                        url: jQuery('#id').val()?"{{ url('/updateIngredient') }}":"{{ url('/addIngredient') }}",
                        method: 'post',
                        data: {
                            id: jQuery('#id').val()?jQuery('#id').val():0,
                            name: jQuery('#name').val(),
                            price: jQuery('#price').val(),
                            _token: jQuery('[name="_token"]').val(),  
                        },
                        success: function(result){
                            if(result.errors)
                            {
                                jQuery('.alert-danger').html('');
                                jQuery.each(result.errors, function(key, value){
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<li>'+value+'</li>');
                                });
                            }
                            else
                            {
                                jQuery('.alert-danger').hide();
                                $('#open').hide();
                                $('#myModal').modal('hide');
                                jQuery('#id').val();
                                jQuery('#name').val();
                                jQuery('#price').val();
                                location.reload();
                            }
                        }
                    });
                });   


          
            });
        </script>        



    @include('layouts.footer')
