@extends('display.app')
@section('content')
<x-categories :categories="$categories" />



<section id="products" class="w-full p-24 flex flex-col">
    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">{{ $variant->name }}</h3>

    <div id="product" class="relative transition-transform duration-300 ease-in-out flex lg:flex-row sm:flex-col md:flex-col">

        <form action="{{ route('addToWishlist') }}" method="post">
            @csrf
            <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">
            <button type="submit" class="flex">
                <li class="text-base mr-4 absolute right-4 top-4 hidden transition-transform duration-300 ease-in-out">
                    <a href="#" id="wishlist" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                        <i class="ri-heart-add-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                    </a>
                </li>
            </button>
        </form>

        <li class="text-base mr-4 absolute right-4 top-14 hidden transition-transform duration-300 ease-in-out">
            <a href="#" id="wishlist" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                <i class="ri-share-forward-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
            </a>
        </li>
        <div class="flex justify-center items-center">
            <div class="flex group w-1/2 h-2/3">
                <div class="w-full relative transition-opacity duration-500 ease-in-out">

                    <img alt="{{asset('images/product_01.jpg')}}" src="{{  $variant->getSingleMediaUrl('image') }}" class="w-full group-hover:hidden">
                    <img alt="{{asset('images/product_01.jpg')}}" src="{{  $variant->getSingleMediaUrl('imageSecond') }}" class="w-full hidden group-hover:flex">
                    </a>
                </div>
            </div>
        </div>
        <div class="product_details flex bg-white lg:w-1/2 justify-center items-center ">
           
            <div class="">
                <h2 class="text-xl hover:text-green-500 mb-2 font-bold">{{ $variant->name }}</h2>
                <h2 class="text-base mb-2">Product Description</h2>
                @foreach (explode("\n", $variant->product->description) as $line)
                @if (!empty($line))
                <p class="mb-1"><i class="fa-solid fa-tag text-red-600 text-lg"></i> {!! nl2br(e($line)) !!}</p>
                @endif
                @endforeach
                <p class="p-2 text-base"><i class="fa-solid fa-indian-rupee-sign pr-1"></i>{{$variant->price}}</p>
                @if($variant->quantity<=4) <p class="p-2 text-base">Only few left</p>
                    @elseif($variant->quantity == 0)
                    <p class="p-2 text-base">Out of Stock</p>
                    @else
                    <p class="p-2 text-base">{{ $variant->quantity }} on stock</p>
                    @endif
                    <p class="font-semibold">Availbale Options</p>
                    <div class="flex ">
                        @foreach($variants as $variant)
                        <div class="flex flex-row m-4 p-2 border-sm border-2 border-black">
                            <a href="{{ route('productVariantDetails' , $variant->id )}}">
                                <div class="w-20 flex relative transition-opacity duration-500 ease-in-out">
                                    <img alt="{{asset('images/product_01.jpg')}}" src="{{  $variant->getSingleMediaUrl('image') }}" class="w-full group-hover:hidden">
                                    <img alt="{{asset('images/product_01.jpg')}}" src="{{  $variant->getSingleMediaUrl('imageSecond') }}" class="w-full hidden group-hover:flex">
                                </div>
                            </a>  
                        </div>
                        @endforeach
                    </div>
                    <div class="cart  hover:bg-green-500 flex justify-center py-2 bg-primary-color text-white   mt-4 w-40">
                        <form action="{{ route('addToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">
                            <button type="submit" class="flex">
                                <a href=""><i class="ri-shopping-cart-line pr-2 "></i></a>
                                <p class="text-white">ADD TO CART</p>
                            </button>
                        </form>
                    </div>
            </div>



        </div>




    </div>
</section>


<x-footer />
@endsection('content')