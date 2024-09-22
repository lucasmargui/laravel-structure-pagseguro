<!-- resources/views/items/show.blade.php -->

@extends('layouts.main')

@section('content')
<div class="container">
    <h2>{{ $item['name'] }}</h2>
    <p>Preço: R$ {{ number_format($item['price'], 2, ',', '.') }}</p>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Voltar</a>
    
    <button class="btn btn-success mt-3" id="buyButton">Comprar</button>
</div>

<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p>Processando sua compra...</p>
                <img id="qrCodeImage" src="" alt="QR Code" style="display: none; max-width: 100%;"/>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('buyButton').addEventListener('click', function() {
        $('#loadingModal').modal('show');

        fetch("{{ route('items.buy', $item['id']) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
          
            if (data.success) {
                               // Exibir a imagem do QR code
                const qrCodeImage = document.getElementById('qrCodeImage');
                qrCodeImage.src = data.data['qr_codes'][0]['links'][0]['href'];
                qrCodeImage.style.display = 'block';
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            $('#loadingModal').modal('hide');
            alert('Erro: ' + error.message);
        });
    });
</script>
@endsection
