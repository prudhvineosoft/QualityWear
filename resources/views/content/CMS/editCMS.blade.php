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
                    @if(Session::has('msg'))
                    <div class="alert alert-info">{{Session::get('msg')}}</div>
                    @endif
                    <form method="POST" enctype="multipart/form-data" action="/dashboard/cms/{{$data->id}}">
                        <h2 class="text-center text-primary">CMS</h2>
                        @csrf()
                        @method("put")
                        <div class="form-group m-auto ">
                            Title <input type="text" class="form-control" name="title" value="{{$data->title}}">
                            @if($errors->has('title'))
                            <label class="text-danger">{{$errors->first('title')}}</label>
                            @endif
                        </div>

                        <div class="form-group m-auto ">
                            Description
                            <textarea class="form-control" name="description"> {{$data->description}}</textarea>
                            @if($errors->has('description'))
                            <label class="text-danger">{{$errors->first('description')}}</label>
                            @endif
                        </div>
                        <div class="form-group m-auto ">
                            Image <input type="file" class="form-control" name="image">
                            @if($errors->has('image'))
                            <label class="text-danger">{{$errors->first('image')}}</label>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/dashboard/cms" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Edit-CMS">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
</body>

</html>