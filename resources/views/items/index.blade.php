
@extends('layouts.main')


@section('content')

<div class="container">
    <div class="row">
        @foreach ($items as $item)
        <div class="col-md-2">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['name'] }}</h5>
                    <p class="card-text">Preço: R$ {{ number_format($item['price'], 2, ',', '.') }}</p>
                    <a href="{{ route('items.show', $item['id']) }}" class="btn btn-primary">Comprar</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection