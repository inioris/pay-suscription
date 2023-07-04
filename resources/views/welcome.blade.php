@extends('template')

@section('content')

   <div class='container py-3'>
        <main>
          <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            @foreach($products as $product)
              <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                  <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">{{ $product['name'] }}</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title">${{ $product['price'] }}<small class="text-body-secondary fw-light">/mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      @foreach($product['features'] as $feature)
                        <li>{{ $feature }}</li>
                      @endforeach
                    </ul>
                    <form action="{{ url('/create-order') }}" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="{{ $product['price'] }}">
                        <button type="submit" class="w-100 btn btn-lg btn-outline-primary">
                            {{ $product['button_text'] }}
                        </button>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
           </div>
        </main>
   </div>
@endsection
