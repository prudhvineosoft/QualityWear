@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">

        {{-- <p style="width: 100%">{{ $udUser}}</p>
        <p style="width: 100%">{{ $udRole}}</p>
        <p style="width: 100%">{{ $udStatus}}</p>
        <p style="width: 100%">{{ $udAddress}}</p> --}}
        <div class="col-md-12 mt-2">
            <div class="bg-transparent d-flex justify-content-between clearfix ">
                <div>
                    <a href="/users" class="btn btn-secondary float-start mb-4">
                        Back
                    </a>
                </div>
                @if(session()->has('updateSuccess'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('updateSuccess') }}
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
                    <h3 class="card-title">User Details</h3>

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
                        <button type="button" class="ml-3 btn btn-secondary" data-toggle="modal"
                            data-target="#modal-lg">
                            Edit User details
                        </button>
                        <div class="modal  fade" id="modal-lg">
                            <div class="modal-dialog modal-lg ">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-gray">
                                        <h4 class="modal-title">Edit</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="p-3" method="POST" action="/editUserPost">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input disabled type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" value="{{  $udUser[0]->email }}">

                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $udUser[0]->name }}" />
                                        </div>
                                        @if ($errors->has('name'))
                                        <label class="alert alert-danger">{{ $errors->first('name') }}</label>
                                        @endif
                                        <div class="form-group">
                                            <x-label for="role_id" value="{{ __('Register as:') }}" />
                                            <select name="role_id" class="form-control" style="width: 100%;">
                                                @foreach ($roles as $each)

                                                @if ($each->name == $udRole[0]->name)
                                                <option selected value="{{ $each->id }}">{{ $each->display_name }}
                                                </option>
                                                @else
                                                <option value="{{ $each->id }}">{{$each->display_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $udUser[0]->id }}">

                                        <button type="submit" class=" btn btn-primary">Submit</button>
                                    </form>
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
                    <h3 class="card-title">Order History</h3>

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
                                                <a href="/dashboard/orderManagement/{{ $each->id }}"><i
                                                        class="far fa-folder-open edit text-secondary"></i></a>

                                                <form method="POST" action="/dashboard/orderManagement/{{ $each->id }}">
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
                        <!-- /.card-body -->
                    </div>
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