@include('layouts.customHead')

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
                    <form method="POST" enctype="multipart/form-data" action="/cms">
                        <h2 class="text-center text-primary">CMS</h2>
                        @csrf()
                        <div class="form-group m-auto ">
                            Title <input type="text" class="form-control" name="title">
                            @if($errors->has('title'))
                            <label class="text-danger">{{$errors->first('title')}}</label>
                            @endif
                        </div>

                        <div class="form-group m-auto ">
                            Description
                            <textarea class="form-control" name="description"></textarea>
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
                            <a href="/cms" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Add-CMS">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
</body>

</html>