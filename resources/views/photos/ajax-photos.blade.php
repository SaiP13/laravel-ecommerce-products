<div>
@foreach($photos as $r)
    <img src="{{ url('sai/',$r->photo_name)}}" height="150" width="150">
@endforeach
</div>
