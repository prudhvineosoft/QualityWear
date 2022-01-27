@include('layouts.customHead')

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

                @if (session()->has('successDeleteCMS'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successDeleteCMS') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorDeleteCMS'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Failed!</strong> {{ session()->get('errorDeleteCMS') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="card  ">
                <div class="card-header bg-gray table-heading pl-5 pr-5">
                    <h3 class="card-title">CMS</h3>
                    <a href="configuration/create" class="btn btn-primary ml-auto">Add configruation</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark text-center">
                    <table id="example2" class="table bg-dark table-hover">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Contact</th>
                                <th>Notification Email</th>
                                <th>Admin Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sn=1;
                            @endphp
                            @foreach($data as $i)
                            <tr class="tr-custom">
                                <td>{{$sn++}}</td>
                                <td>{{$i->phone_no}}</td>
                                <td>{{$i->notification_email}}</td>
                                <td>{{$i->admin_email}}</td>
                                <td>
                                    <a href="/configuration/{{$i->id}}/edit" class="btn btn-info">Edit</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
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