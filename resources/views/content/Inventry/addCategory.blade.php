@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">
        <div class="col-md-12 mt-2">
            <div class="add-user-form ">
                <div class="col-5 card mt-3 p-3 bg-dark">
                    <form class="bg-dark" method="POST" action="/category">
                        @csrf
                        <!-- Name -->
                        <div class="form-group">
                            <label for="c_name" class="text-light">Name</label>
                            <input type="text" name="c_name" class="form-control" id='c_name' placeholder="Category" />
                        </div>
                        @if ($errors->has('c_name'))
                        <label class="text-danger">{{ $errors->first('c_name') }}</label>
                        @endif

                        <!-- Description Address -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" id='description'
                                placeholder="Description" />
                        </div>
                        @if ($errors->has('description'))
                        <label class="text-danger">{{ $errors->first('name') }}</label>
                        @endif
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/category" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Add-Category">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
</body>

</html>