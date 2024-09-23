<!-- resources/views/items/show.blade.php -->

@extends('layouts.main')

@section('content')

<style>

    .status {
        position: relative;
        width: 400px; /* Ajuste conforme necessário */
        height: 600px; /* Ajuste conforme necessário */
        overflow: hidden;
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        text-align: center;
    }
   
    .status-await,
    .status-complete {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .status-await {
        opacity: 1; /* Começa visível */
    }

    .status-complete {
        opacity: 0; /* Começa invisível */
    }

    .status.complete .status-await {
        opacity: 0; /* Fica invisível */
    }

    .status.complete .status-complete {
        opacity: 1; /* Fica visível */
    }

</style>


<div class='custom-container'>
  <div class='background-element' id='background-element'></div>
  <div class='highlight-window' id='product-img'>
    <div class='highlight-overlay' id='highlight-overlay'></div>
  </div>
  <div class='window'>
    <div class='custom-main-content'>
      <h2>Tiger of Sweden</h2>
      <h1>LEONARD COAT</h1>
      <h3>MINIMALISTIC COAT IN COTTON-BLEND</h3>
      <div class='description' id='description'>
        Men's minimalistic overcoat in cotton-blend. Features a stand-up collar, concealed front closure and single back vent. Slim fit with clean, straight shape. Above-knee length.
      </div>
      <div class='highlight-window mobile' id='product-img'>
        <div class='highlight-overlay' id='highlight-overlay-mobile'></div>
      </div>
      <div class='options'>
        <div class='color-options'>
          Color:
          <div class='color-picker'>
            <div class='color overlay' id='color-overlay'>
              <div class='check'></div>
            </div>
            <div class='color color-a' id='color-a'></div>
            <div class='color color-b' id='color-b'></div>
          </div>
          <span class='small' style='color:#457'>COLOR: <span id='color-name'>BLUES / 2V5</span></span>
        </div>
        <div class='size-picker'>
          Size:
          <div class='range-picker' id='range-picker'>
            <div>44</div>
            <div>46</div>
            <div>48</div>
            <div class='active'>50</div>
            <div>52</div>
            <div>54</div>
          </div>
          <a class='small align-right' href='#'>VIEW SIZE-CHART</a>
        </div>
      </div>
      <div class='divider'></div>
      <div class='purchase-info'>
        <div class='price'>${{ $item['price'] }}.00</div>
        <button id="buyButton">Buy</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center d-flex flex-column align-items-center">

          
      

            <div class="card mt-4 shadow-sm" style="border: 1px solid #ccc; border-radius: 5px;">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <img src="{{ $item['image_url'] }}" class="img-fluid" alt="{{ $item['name'] }}" style="max-height: 150px; object-fit: cover; width: 100%; margin-top:10px; border-radius: 5px;">
                    </div>
                    <div class="col">
                        <div class="card-body px-3">
                            <h5 class="card-title font-weight-bold">{{ $item['name'] }}</h5>
                            <p class="card-text text-muted">{{ $item['description'] }}</p>
                            <p class="card-price font-weight-bold" style="color: #28a745;">${{ $item['price'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="status await" id="status" >
                <div class="status-await">

                <div style="display: flex; flex-direction: column; align-items: center;">
                   
                    
                    <div class="spinner-border mt-4"></div>
                    <p>Awaiting...</p>
                    <img id="qrCodeImage" src="https://logospng.org/download/pix/logo-pix-256.png" alt="QR Code" style="max-width: 90%; height: auto;"/>

                </div>
                    
                </div>
                <div class="status-complete mt-4">
                    <i class="fas fa-check" style="color: green;"></i> Purchase Complete!
                </div>
            </div>
                
                


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

    document.getElementById('range-picker').addEventListener('click', function(e) {
        var sizeList = document.getElementById('range-picker').children;
        for (var i = 0; i <= sizeList.length - 1; i++) {
            console.log(sizeList[i].classList);
            if (sizeList[i].classList.contains('active')) {
            sizeList[i].classList.remove('active');
            }
        }
        e.target.classList.add('active');
        })
        
        document.getElementById('color-a').addEventListener('click', function() {
        document.getElementById('color-overlay').style.transform = 'translateX(-0.5px)';
        document.getElementById('background-element').style.backgroundColor = '#333';
        document.getElementById('highlight-overlay').style.opacity = '1';
        document.getElementById('highlight-overlay-mobile').style.opacity = '1';
        document.getElementById('color-name').innerHTML = "BLACK / 050";
        document.getElementById('color-name').style.color = '#333'
        
        })
        document.getElementById('color-b').addEventListener('click', function() {
        document.getElementById('color-overlay').style.transform = 'translateX(45px)';
        document.getElementById('background-element').style.backgroundColor = '#457';
        document.getElementById('highlight-overlay').style.opacity = '0';
        document.getElementById('highlight-overlay-mobile').style.opacity = '0';
        document.getElementById('color-name').innerHTML = "BLUES / 2V5";
        document.getElementById('color-name').style.color = '#457'
        })

</script>
@endsection
