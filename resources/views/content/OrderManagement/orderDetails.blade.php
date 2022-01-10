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
                    <a href="/dashboard/orderManagement" class="btn btn-secondary float-start mb-4">
                        Back
                    </a>
                </div>
                @if(session()->has('updateSuccessOrder'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('updateSuccessOrder') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('updateErrorOrder'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('updateErrorOrder') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="card card-success shadow-sm">
                <div class="card-header card-color">
                    <h3 class="card-title">Order Details</h3>

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
                                <h5 class="h-name">Order ID</h5>
                                <h5 class="value">{{ $order->order_id }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Order Status</h5>
                                @if($order->o_status == "rejected")
                                <h5 class="value text-danger font-weight-bold">Rejected</h5>
                                @elseif (empty($order->o_status))
                                <h5 class="value text-gray font-weight-bold">Pendng</h5>
                                @elseif ($order->o_status == 'accepted')
                                <h5 class="value text-success font-weight-bold">Accepted</h5>
                                @endif
                            </div>
                            <div class="details">
                                <h5 class="h-name">Created at</h5>
                                <h5 class="value">{{ $order->created_at }}</h5>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="details">
                                <h5 class="h-name">User Id</h5>
                                <h5 class="value">{{ $order->user_id }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Product Id</h5>
                                <h5 class="value">{{ $order->product_id }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Payment method</h5>
                                <h5 class="value">{{ $order->payment_method }}</h5>
                            </div>
                        </div>
                        <button type="button" class="ml-3 btn btn-secondary" data-toggle="modal"
                            data-target="#modal-sm">
                            Accept/Reject
                        </button>
                        <div class="modal  fade" id="modal-sm">
                            <div class="modal-dialog modal-sm ">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-gray">
                                        <h4 class="modal-title">Edit</h4>
                                        <button type="button" class="close text-light" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="bg-dark" method="POST"
                                            action="/dashboard/orderManagement/{{ $order->id }}" class="">
                                            @csrf
                                            @method('PUT')
                                            <!-- status -->
                                            <div class="form-group">
                                                <label for="b_description">Order Status</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input ml-3" type="radio" name="o_status"
                                                        id="inlineRadio1" value='accepted' {{ $order->o_status ==
                                                    'accepted' ?
                                                    'checked' : '' }} >
                                                    <label class="form-check-label" for="inlineRadio1">Accept</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="o_status"
                                                        id="inlineRadio2" value='rejected' {{ $order->o_status ==
                                                    'rejected' ?
                                                    'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Reject</label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    aria-label="Close">
                                                    Cansel
                                                </button>
                                                <input type="submit" class="btn btn-info" value="Edit-order">
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
                    <h3 class="card-title">Product Details</h3>

                    <div class="card-tools ">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark">
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
                                @if($product[0]->rating == 0)
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
                    </div>
                </div>

                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-warning shadow-sm">
                <div class="card-header ">
                    <h3 class="card-title">User Details</h3>

                    <div class="card-tools ">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark">
                    <div class="row">
                        <div class="col-6 text-center">
                            <div class="details">
                                <h5 class="h-name">User Name</h5>
                                <h5 class="value">{{ $udUser[0]->name }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">User Email</h5>
                                <h5 class="value">{{ $udUser[0]->email }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">Created at</h5>
                                <h5 class="value">{{ $udUser[0]->created_at }}</h5>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="details">
                                <h5 class="h-name">User Role</h5>
                                <h5 class="value">{{ $udRole[0]->display_name }}</h5>
                            </div>
                            <div class="details">
                                <h5 class="h-name">User Status</h5>
                                @if ($udStatus[0]->status == 0)
                                <h5 class="value text-danger">In active</h5>
                                @else
                                <h5 class="value text-success">Active</h5>
                                @endif
                            </div>
                            <div class="details">
                                <h5 class="h-name">Updated at</h5>
                                <h5 class="value">{{ $udUser[0]->updated_at }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>



    @endsection

</body>

</html>