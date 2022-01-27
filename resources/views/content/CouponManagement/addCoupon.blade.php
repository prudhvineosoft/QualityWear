@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">
        <div class="col-md-12 mt-2">
            <div class="add-user-form ">
                <div class="col-5 card mt-3 p-3 bg-dark">
                    <form class="bg-dark" method="POST" action="/coupon" enctype="multipart/form-data">
                        @csrf
                        <!-- code -->
                        <div class="form-group">
                            <label for="code" class="text-light">Coupon Code</label>
                            <input type="text" name="code" class="form-control" id='code' placeholder="Code" />
                        </div>
                        @if ($errors->has('code'))
                        <label class="text-danger">{{ $errors->first('code') }}</label>
                        @endif

                        <!-- Coupon Type -->
                        <div class="form-group">
                            <label for="type" class="text-light">Coupon Type</label>
                            <select class="form-control" name="type">
                                <option value="">Select</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>
                        @if ($errors->has('type'))
                        <label class="text-danger">{{ $errors->first('type') }}</label>
                        @endif

                        <!-- Coupon Value -->
                        <div class="form-group">
                            <label for="value" class="text-light">Coupon Value</label>
                            <input type="text" name="value" class="form-control" id='value' placeholder="Value" />
                        </div>
                        @if ($errors->has('value'))
                        <label class="text-danger">{{ $errors->first('value') }}</label>
                        @endif

                        <!-- Cart Value -->
                        <div class="form-group">
                            <label for="cart_value" class="text-light">Cart Value</label>
                            <input type="text" name="cart_value" class="form-control" id='cart_value'
                                placeholder="Cart value" />
                        </div>
                        @if ($errors->has('cart_value'))
                        <label class="text-danger">{{ $errors->first('cart_value') }}</label>
                        @endif

                        <div class="mt-1 text-center">
                            <div id="thumb-output" class="preview-container">
                                <h4 class="text-danger" id="limitError"></h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/coupon" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Add-Coupon">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
</body>

</html>