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
