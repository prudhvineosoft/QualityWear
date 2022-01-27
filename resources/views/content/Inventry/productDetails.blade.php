@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">

        <div class="col-md-12 mt-2">
            <div class="bg-transparent d-flex justify-content-between clearfix ">
                <div>
                    <a href="/product" class="btn btn-secondary float-start mb-4">
                        Back
                    </a>
                </div>
                @if(session()->has('updateSuccessProduct'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('updateSuccessProduct') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('updateErrorProduct'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Fail!</strong> {{ session()->get('updateErrorProduct') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session()->has('successDeleteOrder'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successDeleteOrder') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorDeleteOrder'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Failed!</strong> {{ session()->get('errorDeleteOrder') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="card card-success shadow-sm">
                <div class="card-header card-color">
                    <h3 class="card-title">Product Details</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark text-dark">
                    <div class="row">
                        <div class="col-6 text-center">
                            <div class="details">
                                <h5 class="h-name">Product Name</h5>
                                <h5 class="value">{{ $product[0]->name }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Product Price</h5>
                                <h5 class="value">{{ $product[0]->price }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Product Quantity</h5>
                                @if($product[0]->quantity == 0);
                                <h5 class="value text-danger">Out Of Stock</h5>
                                @else
                                <h5 class="value">{{ $product[0]->quantity }}</h6>
                                    @endif
                            </div>
                            <div class="details">
                                <h5 class="h-name">Created at</h5>
                                <h5 class="value">{{ $product[0]->created_at }}</h5>
                            </div>
                        </div>
                        <div class="col-6 text-center">

                            <div class="details">
                                <h5 class="h-name">Category</h5>
                                @foreach ($categories as $each)
                                @if($each->id == $product[0]->category_id)
                                <h5 class="value">{{ $each->c_name }}</h5>
                                @endif
                                @endforeach
                            </div>
                            <div class="details">
                                <h5 class="h-name">Product Code</h5>
                                <h5 class="value">{{ $product[0]->code }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Product Rating</h5>
                                @if($product[0]->rating == 0);
                                <h5 class="value text-danger">No Rating</h5>
                                @else
                                <h5 class="value">{{ $product[0]->rating }}</h6>
                                    @endif
                            </div>
                            <div class="details">
                                <h5 class="h-name">Description</h5>
                                <h6 class="value">{{ $product[0]->description }}</h6>
                            </div>
                        </div>
                        <div class="row mb-3 p-3">
                            @foreach ($productImages as $image)
                            <img src="{{ asset('uploads/'.$image->img_path) }}" class="col-3 ml-auto mr-auto " alt="">
                            @endforeach
                        </div>
                        <button type="button" class="ml-3 btn btn-secondary" data-toggle="modal"
                            data-target="#modal-lg">
                            Edit Product
                        </button>
                        <div class="modal  fade" id="modal-lg">
                            <div class="modal-dialog modal-lg ">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-gray">
                                        <h4 class="modal-title">Edit product</h4>
                                        <button type="button" class="close text-light" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="bg-dark row" method="POST" action="/product/{{ $product[0]->id }}"
                                            accept-charset="utf-8" enctype="multipart/form-data" class="">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-6">
                                                {{-- category --}}
                                                <div class="form-group">
                                                    <label for="category_id">Category</label>
                                                    <select name="category_id" class="form-control" id="category_id"
                                                        style="width: 100%;">
                                                        <option>Category</option>
                                                        @foreach ($categories as $each)
                                                        @if($each->id == $product[0]->category_id )
                                                        <option value="{{ $each->id }}" selected>{{$each->c_name }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $each->id }}">{{$each->c_name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label for="name" class="text-light">Name</label>
                                                    <input type="text" name="name" class="form-control" id='name'
                                                        value="{{ $product[0]->name }}" placeholder="name" />
                                                </div>
                                                @if ($errors->has('name'))
                                                <label class="text-danger">{{ $errors->first('name') }}</label>
                                                @endif

                                                <!-- Description Address -->
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" name="description" class="form-control"
                                                        value="{{ $product[0]->description }}" id='description'
                                                        placeholder="Description" />
                                                </div>
                                                @if ($errors->has('description'))
                                                <label class="text-danger">{{ $errors->first('name') }}</label>
                                                @endif
                                                {{-- price --}}
                                                <div class="form-group">
                                                    <label for="price" class="text-light">Price</label>
                                                    <input type="number" name="price" class="form-control" id='price'
                                                        value="{{ $product[0]->price }}" placeholder="price" />
                                                </div>
                                                @if ($errors->has('price'))
                                                <label class="text-danger">{{ $errors->first('price') }}</label>
                                                @endif
                                                {{-- quantity --}}
                                                <div class="form-group">
                                                    <label for="quantity" class="text-light">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control"
                                                        value="{{ $product[0]->quantity }}" id='quantity'
                                                        placeholder="Quantity" />
                                                </div>
                                                @if ($errors->has('quantity'))
                                                <label class="text-danger">{{ $errors->first('quantity') }}</label>
                                                @endif



                                            </div>
                                            <div class="col-6">
                                                {{-- images --}}
                                                <div class="form-group">
                                                    <label>Add Images</label>

                                                    <input type="file" id="file-input" class="form-control"
                                                        name="image[]" placeholder="Choose images" multiple />
                                                    <small>you can add only 4 Images (jpg,jpeg,png,gif)</small>
                                                    <small>If You edit the images previous images will be
                                                        deleted</small>

                                                </div>
                                                <div class="mt-1 text-center">
                                                    <div id="thumb-output" class="preview-container">
                                                        <h4 class="text-danger" id="limitError"></h4>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="d-flex justify-content-between mt-4 col-12">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    aria-label="Close">
                                                    Close
                                                </button>
                                                <input type="submit" class="btn btn-info" value="Edit-Product">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-gray shadow-sm">
                <div class="card-header ">
                    <h3 class="card-title">Orders</h3>

                    <div class="card-tools ">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark">
                    <div class="card  ">
                        <!-- /.card-header -->
                        <div class="card-body bg-dark text-center">
                            <table id="example2" class="table bg-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Order Id</th>
                                        <th>User Id</th>
                                        <th>Product Id</th>
                                        <th>Payment Method</th>
                                        <th>Order Status</th>
                                        <th>Order Received On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count = 0
                                    @endphp
                                    @foreach ($orderData as $each)
                                    @php
                                    $count += 1
                                    @endphp
                                    <tr class="tr-custom">
                                        <td>{{ $count }}</td>
                                        <td>{{ $each->order_id }}</td>
                                        <td>{{ $each->user_id }}</td>
                                        <td>{{ $each->product_id }}</td>
                                        <td>{{ $each->payment_method }}</td>



                                        @if($each->o_status == "rejected")
                                        <td class="text-danger font-weight-bold">Rejected</td>
                                        @elseif (empty($each->o_status))
                                        <td text-gray font-weight-bold>Pendng</td>
                                        @elseif ($each->o_status == 'accepted')
                                        <td class="text-success font-weight-bold">Accepted</td>

                                        @endif
                                        <td>{{ $each->created_id }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="orderManagement/{{ $each->id }}"><i
                                                        class="far fa-folder-open edit text-secondary"></i></a>

                                                <form method="POST" action="/orderManagement/{{ $each->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return myFunction();" type="submit"
                                                        class="delete-button"><i
                                                            class="fas fa-trash delete"></i></button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            {{ $orderData->links('pagination::bootstrap-4') }}

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
         $('#file-input').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                 
                var data = $(this)[0].files; //this file data
                var length = 0 ;
                $.each(data,function(index, file) {
                    length += 1
                })
                console.log(length);
                if(length < 5){
                    $('#limitError').html('')
                $.each(data, function(index, file){ //loop though each file
                    
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb mt-3 col-5').attr('src', e.target.result); //create image element 
                            $('#thumb-output').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
                                     
                }else {
                    $('#limitError').html('Limit only 4')
                }
            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
         });
        });
         
    </script>
    <script>
        function myFunction() {
        if(!confirm("Are You Sure to delete this"))
        event.preventDefault();
    }
    </script>
    @endsection

</body>

</html>