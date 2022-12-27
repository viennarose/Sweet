@extends('layouts.admin')

@section('content')
<div class="container">
    <div>
        <h1 class="text-center p-4">Available Cakes</h1>
            <div class="container">
                @if($images->count() > 0)
                    <div class="row g-5 ">
                    @foreach($images as $img)
                    @if($img->status==0)
                    <div class="col">
                        <div class="card m-2 shadow-lg btnh" style="width: 300px; height:300px">
                            <img class="card-img-top" src="{{asset('storage')}}/{{$img->image}}" alt="">
                        <div class="card-body">
                        <h4 class="card-title mt-2">{{$img->category_name}}</h3>
                        <p class="" style="font-size: 10px; text-align: justify;">{{$img->description}}</p>
                        </div></a>
                    </div>
                    </div>
                    @endif
                    @endforeach
                @endif
            </div>
    </div>
</div>
@endsection
