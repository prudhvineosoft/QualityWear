@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">
        <div class="col-md-12 mt-2">
            <div class="add-user-form">
                <div class="col-11 card mt-3 p-3 bg-dark">
                    <form class="bg-dark row" method="POST" action="/product" accept-charset="utf-8"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="col-6">
                            {{-- category --}}
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" id="category_id" style="width: 100%;">
                                    <option>Category</option>
                                    @foreach ($categories as $each)
                                    <option value="{{ $each->id }}">{{$each->c_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="text-light">Name</label>
                                <input type="text" name="name" class="form-control" id='name' placeholder="name" />
                            </div>
                            @if ($errors->has('name'))
                            <label class="text-danger">{{ $errors->first('name') }}</label>
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
                            {{-- price --}}
                            <div class="form-group">
                                <label for="price" class="text-light">Price</label>
                                <input type="number" name="price" class="form-control" id='price' placeholder="price" />
                            </div>
                            @if ($errors->has('price'))
                            <label class="text-danger">{{ $errors->first('price') }}</label>
                            @endif
                            {{-- quantity --}}
                            <div class="form-group">
                                <label for="quantity" class="text-light">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id='quantity'
                                    placeholder="Quantity" />
                            </div>
                            @if ($errors->has('quantity'))
                            <label class="text-danger">{{ $errors->first('quantity') }}</label>
                            @endif
                            {{-- code --}}
                            <div class="form-group">
                                @php
                                function unique_code($limit)
                                {
                                return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
                                }
                                @endphp
                                <input id="code" type="hidden" class="form-control " name="code"
                                    value="@php echo unique_code(16); @endphp" readonly>
                            </div>
                            @if ($errors->has('code'))
                            <label class="text-danger">{{ $errors->first('code') }}</label>
                            @endif


                        </div>
                        <div class="col-6">
                            {{-- images --}}
                            <div class="form-group">
                                <label>Add Images</label>

                                <input type="file" id="file-input" class="form-control" name="image[]"
                                    placeholder="Choose images" multiple />
                                <small>you can add only 4 Images (jpg,jpeg,png,gif)</small>
                                @if($errors->has('name'))
                                <label class="text-danger">{{$errors->first('name')}}</label>
                                @endif
                            </div>
                            <div class="mt-1 text-center">
                                <div id="thumb-output" class="preview-container">
                                    <h4 class="text-danger" id="limitError"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4 col-12">
                            <a href="/category" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Add-Product">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
         $('#file-input').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                 
                var data = $(this)[0].files; //this file data
                var length = 0 ;
                $.each(data,function(index, file) {
                    length += 1
                })
                console.log(length);
                if(length < 5){
                    $('#limitError').html('')
                $.each(data, function(index, file){ //loop though each file
                    
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb mt-3 col-5').attr('src', e.target.result); //create image element 
                            $('#thumb-output').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
                                     
                }else {
                    $('#limitError').html('Limit only 4')
                }
            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
         });
        });
         
    </script>
    @endsection
</body>

</html>