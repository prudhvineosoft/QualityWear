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

            <div class="card  ">
                <div class="card-header bg-gray table-heading pl-5 pr-5">
                    <h3 class="card-title">Orders Table</h3>
                </div>
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

                                        <form method="POST" action="/dashboard/orderManagement/{{ $each->id }}">
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

                    {{ $orderData->links('pagination::bootstrap-4') }}

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