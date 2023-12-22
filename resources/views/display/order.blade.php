@extends('display.app')
@section('content')
<x-categories :categories="$categories" />
<section id="products" class="w-full p-24 mb-20">
    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">Your order's are Here</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($orders->count() > 0)
        <div class="product grid lg:grid-cols-4 gap-8 md:grid-cols-2 sm:grid-cols-2">
            @foreach($orders as $order)
                <p>{{ $order->name }}</p>
            @endforeach
        </div>
    @else
    
    <x-empty 
    src="{{ asset('icons/bag.jpg') }}"
     imageDimensions="w-40"
     heading="You have no Orders yet"
     content="We have exsiting offers for you, fill your wardobe with class"
     buttonContent="Start Shopping"/>
    @endif
</section>

<x-footer  class=""/>

@endsection()