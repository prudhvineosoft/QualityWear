<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">
        <div class="col-md-12 mt-2">
            <div class="bg-transparent d-flex justify-content-between clearfix ">
                <div>
                    <a href="/dashboard" class="btn btn-secondary float-start mb-4">
                        Back
                    </a>
                </div>
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

            <div class="card">
                <div class="card-header bg-gray table-heading pl-5 pr-5">
                    <h3 class="card-title">Products Table</h3>
                    <a href="product/create" class="btn btn-primary ml-auto">Add Product</a>
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

                                        <form method="POST" action="/dashboard/product/{{ $each->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return myFunction();" type="submit"
                                                class="delete-button"><i class="fas fa-trash delete"></i></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    {{ $productsData->links('pagination::bootstrap-4') }}

                </div>
                <!-- /.card-body -->
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