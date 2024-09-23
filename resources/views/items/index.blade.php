
@extends('layouts.main')


@section('content')

<style>

.fixed-image {
    height: 300px; /* Defina a altura que você quer para as imagens */
    object-fit: cover;
}

</style>

<div class="container">
<div class='background-element' id='background-element'></div>
    <div class="row">
        @foreach($items as $item)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ $item['image_url'] }}" class="img-fluid card-img-top fixed-image" alt="{{ $item['name'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['name'] }}</h5>
                    <p class="card-text">{{ $item['description'] }}</p>
                    <p class="card-text text-muted">${{ $item['price']}}.00</p>
                    <a href="{{ route('items.show', $item['id']) }}" class="btn btn-dark">View Details</a>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>


@endsection