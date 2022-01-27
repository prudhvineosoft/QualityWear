@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">

        <div class="col-md-12 mt-2">
            <div class="bg-transparent d-flex justify-content-between clearfix ">
                <div>
                    <a href="/category" class="btn btn-secondary float-start mb-4">
                        Back
                    </a>
                </div>
                @if(session()->has('updateSuccessCategory'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('updateSuccessCategory') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('updateErrorCategory'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('updateErrorCategory') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('successProduct'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successProduct') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorProduct'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('errorProduct') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session()->has('successDeleteProduct'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successDeleteProduct') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorDeleteProduct'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('errorDeleteProduct') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="card card-success shadow-sm">
                <div class="card-header card-color">
                    <h3 class="card-title">Category Details</h3>

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
                                <h5 class="h-name">Category Name</h5>
                                <h5 class="value">{{ $category[0]->c_name }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Created at</h5>
                                <h5 class="value">{{ $category[0]->created_at }}</h5>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="details">
                                <h5 class="h-name">Category Description</h5>
                                <h5 class="value">{{ $category[0]->description }}</h5>
                            </div>

                        </div>
                        <button type="button" class="ml-3 btn btn-secondary" data-toggle="modal"
                            data-target="#modal-md">
                            Edit Catagory
                        </button>
                        <div class="modal  fade" id="modal-md">
                            <div class="modal-dialog modal-md ">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-gray">
                                        <h4 class="modal-title">Edit</h4>
                                        <button type="button" class="close text-light" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="bg-dark" method="POST" action="/category/{{ $category[0]->id }}"
                                            class="">
                                            @csrf
                                            @method('PUT')
                                            <!-- Name -->
                                            <div class="form-group">
                                                <label for="c_name" class="text-light">Name</label>
                                                <input type="text" name="c_name" class="form-control" id='c_name'
                                                    placeholder="Category" value="{{ $category[0]->c_name }}" />
                                            </div>
                                            @if ($errors->has('c_name'))
                                            <label class="text-danger">{{ $errors->first('c_name') }}</label>
                                            @endif

                                            <!-- Description Address -->
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" class="form-control"
                                                    id='description' placeholder="Description"
                                                    value="{{ $category[0]->description }}" />
                                            </div>
                                            @if ($errors->has('description'))
                                            <label class="text-danger">{{ $errors->first('name') }}</label>
                                            @endif
                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    aria-label="Close">
                                                    Cansel
                                                </button>
                                                <input type="submit" class="btn btn-info" value="Edit-User">
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
                    <h3 class="card-title">List Of Products</h3>

                    <div class="card-tools ">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark">
                    <div class="card">
                        <div class="card-header bg-gray table-heading pl-5 pr-5">
                            <h3 class="card-title">Products Table</h3>
                            <a href="/product/create" class="btn btn-primary ml-auto">Add Product</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body bg-dark text-center">
                            <table id="example2" class="table bg-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count = 0
                                    @endphp
                                    @foreach ($productsData as $each)
                                    @php
                                    $count += 1
                                    @endphp
                                    <tr class="tr-custom">
                                        <td>{{ $count }}</td>
                                        <td>{{ $each->name }}</td>
                                        <td>{{ $each->price }} /-</td>
                                        <td>{{ $each->quantity }}</td>
                                        <td>{{ $each->c_name }}</td>
                                        <td>{{ $each->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="product/{{ $each->id }}"><i
                                                        class="far fa-folder-open edit text-secondary"></i></a>

                                                <form method="POST" action="/product/{{ $each->id }}">
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

                            {{ $productsData->links('pagination::bootstrap-4') }}

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
                if(!confirm("Are You Sure to delete this"))
                event.preventDefault();
            }
    </script>
    @endsection

</body>

</html>