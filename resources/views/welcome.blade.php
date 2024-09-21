@extends('layouts.main')


@section('content')


    <div id="search-container" class="col-md-12">
        <h1>Busque um evento</h1>
    </div>

    <div class="col-md-12">
             @if ($data)
            <img src="{{ $data['qr_codes'][0]['links'][0]['href'] }}" alt="">
            @endif
    </div>
</div>




@endsection