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
                @if(session()->has('successBanner'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successBanner') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorBanner'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Error!</strong> {{ session()->get('errorBanner') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session()->has('successDeleteBanner'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successDeleteBanner') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorDeleteBanner'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Failed!</strong> {{ session()->get('errorDeleteBanner') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session()->has('successBannerUpdate'))
                <div class=" alert alert-success alert-dismissible fade show" style="" role="alert">
                    <strong>Success!</strong> {{ session()->get('successBannerUpdate') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session()->has('errorBannerUpdate'))
                <div class=" alert alert-danger alert-dismissible fade show" style="" role="alert">
                    <strong>Failed!</strong> {{ session()->get('errorBannerUpdate') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <div class="card  ">
                <div class="card-header bg-gray table-heading pl-5 pr-5">
                    <h3 class="card-title">Banner Table</h3>
                    <a href="banner/create" class="btn btn-primary ml-auto">Add Banner</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-dark text-center">
                    <table id="example2" class="table bg-dark table-hover">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th style="width:30%">Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 0
                            @endphp
                            @foreach ($bannerData as $each)
                            @php
                            $count += 1
                            @endphp
                            <tr class="tr-custom">
                                <td>{{ $count }}</td>
                                <td><img src="{{ asset('uploads/'.$each->b_img_path) }}" class="col-6 ml-auto mr-auto "
                                        alt=""></td>
                                <td>{{ $each->b_name }}</td>
                                @if ($each->b_status == 1)
                                <td class="font-weight-bold text-danger">In active</td>
                                @else
                                <td class="font-weight-bold text-success">Active</td>
                                @endif
                                <td>{{ $each->b_description }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="banner/{{ $each->id }}/edit"><i
                                                class="fas fa-edit edit text-info"></i></a>

                                        <form method="POST" action="/dashboard/banner/{{ $each->id }}">
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

                    {{ $bannerData->links('pagination::bootstrap-4') }}

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