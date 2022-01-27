@include('layouts.customHead')

<body>
    @extends('layouts.master')

    @section('content')
    <div class="text-light">
        <div class="col-md-12 mt-2">
            <div class="add-user-form ">
                <div class="col-5 card mt-3 p-3 bg-dark">
                    <form class="bg-dark" method="POST" action="/banner/{{ $banner->id }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="form-group">
                            <label for="b_name" class="text-light">Name</label>
                            <input type="text" name="b_name" class="form-control" id='b_name' placeholder="Category"
                                value="{{ $banner->b_name }}" disabled />
                        </div>
                        @if ($errors->has('b_name'))
                        <label class="text-danger">{{ $errors->first('b_name') }}</label>
                        @endif

                        <!-- Description Address -->
                        <div class="form-group">
                            <label for="b_description">Description</label>
                            <input type="text" name="b_description" class="form-control" id='b_description'
                                placeholder="Description" value="{{ $banner->b_description }}" />
                        </div>
                        @if ($errors->has('b_description'))
                        <label class="text-danger">{{ $errors->first('b_description') }}</label>
                        @endif

                        <!-- status -->
                        <div class="form-group">
                            <label for="b_description">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="radio" name="b_status" id="inlineRadio1"
                                    value=0 {{ $banner->b_status == '0' ? 'checked' : '' }} >
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="b_status" id="inlineRadio2" value=1
                                    {{ $banner->b_status == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">In Active</label>
                            </div>
                        </div>
                        @if ($errors->has('b_status'))
                        <label class="text-danger">{{ $errors->first('b_status') }}</label>
                        @endif

                        <div class="form-group">
                            <label>Add Image</label>

                            <input type="file" id="file-input" class="form-control" name="image[]"
                                placeholder="Choose images" multiple />
                            @if($errors->has('name'))
                            <label class="text-danger">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                        <div class="mt-1 text-center">
                            <div id="thumb-output" class="preview-container">
                                <h4 class="text-danger" id="limitError"></h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/banner" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Edit-Category">
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