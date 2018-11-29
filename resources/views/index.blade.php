<!DOCTYPE html>

<html>

<head>

    <title>Laravel 5.7 image upload example</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


</head>
<style>
    .clear{
        clear:both;
    }
</style>
<body>

    <div class="container">
        <div class="panel panel-primary">
          <div class="panel-heading"><h2>Laravel 5.7 image upload example </h2></div>

          <div class="panel-body">

            @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

            </div>


            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ URL::to('upload') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                        <div class="form-row">
                            <div class="col-md-6">
                                <label>Image Title</label>
                                <input type="text" class="form-control is-valid" name="title" placeholder="Input image title"  required>
                             </div>
                            <div class="col-md-6">
                                <label>Image Tags</label>
                                <div id="tag-form">
                                     <input type="text" id="tag" class="form-control is-valid" name="tag[]" placeholder="Input image tag" required>
                                </div>

                                <a href="#" id="filldetails" onclick="addFields()">Add More Tags</a>



                            </div>
                        </div>
                        <div class="form-row ">
                             <div class="col-md-6">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                </div>
            </form>

          </div>
        </div>
        <div class="panel panel-primary">

            <div class="panel-heading">
                <h2>Image Uploaded</h2>
            </div>
             <div class="panel-body">
                    <form id="search-form">
                        @csrf
                       <div class="form-row ">
                             <div class="col-md-6">
                                <input type="text" name="keywords" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="button" onClick="search();" class="btn btn-success">Search Tags</button>
                            </div>
                        </div>
                    </form>
                    <br class="clear"/><br/><br/>
                    <div class="container">
                        <div class="col-md-12" id="image-gallery">
                            @foreach ($data as $item)
                                <div class="col-md-12 clearfix">
                                   <div class="img-thumbnail col-md-4">
                                        <img src = "{{asset('/images/'.$item->filename)}}" alt="image" class="img-responsive"/>
                                   </div>
                                   <div class="title col-md-8">
                                       <h2>{{$item->title}}</h2>
                                       <div class="tags">
                                            <ul>
                                                @foreach ($item->tags as $tag)
                                                    <li>{{$tag->tag}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div> <br class="clear"/><br/>
                            @endforeach


                        </div>
                    </div>

              </div>
        </div>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        var i = 1; // Global Variable for Name

        function addFields(){
            var y = document.createElement("INPUT");
            y.setAttribute("type", "text");
            y.setAttribute("class","form-control");
            y.setAttribute("Name","tag[]");
            y.setAttribute("Placeholder", "Input image title");
            document.getElementById("tag-form").appendChild(y);
            i++;
        }
        function search(){
            var formData = $('#search-form').serialize();
            console.log(formData);
            $.ajax({
                method: "POST",
                url: "{{url('/search')}}",
                data: formData,
                datatype: 'html'
                }).done(function( data ) {
                $('#image-gallery').html(data.html);
            });

        }
    </script>
</body>
</html>