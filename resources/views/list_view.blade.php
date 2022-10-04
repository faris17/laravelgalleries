@foreach ($results as $key => $data )
<div class="card m-2 col-md-2" style="padding:0px;">
    <img src="{{asset('storage/'.$data->folder.'/'.$data->image)}}" class="card-img-top"
        width="100%" alt="Image" height="100%">
    <div class="card-body">
        <p class="card-text"> {{ $data->description }}</p>
    </div>
    <a class="btnDelete" href="{{ route('delete.image', $data->id) }}">
        Delete
    </a>
</div>
@endforeach

{{ $results->links('pagination::bootstrap-5')}}

