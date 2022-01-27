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
                @if(session()->has('successContacts'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successContacts') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorContacts'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Failed!</strong> {{ session()->get('errorContacts') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session()->has('successDelete'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successDelete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorDelete'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>failed!</strong> {{ session()->get('errorDelete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="card  ">
                <div class="card-header bg-gray table-heading pl-5 pr-5">
                    <h3 class="card-title">Contacts Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark text-center">
                    <table id="example2" class="table bg-dark table-hover">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>User Id</th>
                                <th>phone no</th>
                                <th>Message</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 0
                            @endphp
                            @foreach ($contactsData as $each)
                            @php
                            $count += 1
                            @endphp
                            <tr class="tr-custom">
                                <td>{{ $count }}</td>
                                <td>{{ $each->user_id }}</td>
                                <td>{{ $each->phone }}</td>
                                <td>{{ $each->message }}</td>
                                <td>{{ $each->created_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="contacts/{{ $each->id }}"><i
                                                class="far fa-folder-open edit text-secondary"></i></a>

                                        <form method="POST" action="/contacts/{{ $each->id }}">
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

                    {{ $contactsData->links('pagination::bootstrap-4') }}

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