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
            <div class="add-user-form ">
                <div class="col-5 card mt-3 p-3 bg-dark">
                    <div>
                        @if(Session::has('msg'))
                        <label>{{Session::get('msg')}}</label>
                        @endif
                    </div>
                    <form method="post" action="/dashboard/configuration">
                        <h2 class="text-center text-primary">Add Configuration</h2>
                        @csrf()
                        <div class="row form-group m-auto ">
                            Contact <input type="text" class="form-control" name="phone" />
                            @if($errors->has('phone'))
                            <label class="text-danger">{{$errors->first('phone')}}</label>
                            @endif
                        </div>
                        <div class="row form-group m-auto ">
                            Admin email <input type="email" class="form-control" name="adminEmail" />
                            @if($errors->has('adminEmail'))
                            <label class="text-danger">{{$errors->first('adminEmail')}}</label>
                            @endif
                        </div>
                        <div class="row form-group m-auto ">
                            Notification email <input type="email" class="form-control" name="notificationEmail" />
                            @if($errors->has('notificationEmail'))
                            <label class="text-danger">{{$errors->first('notificationEmail')}}</label>
                            @endif
                        </div>

                        <div class="text-center mt-2">
                            <input type="submit" class="btn btn-success" value="submit" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
</body>

</html>