@extends('display.app')
@section('content')
<x-categories :categories="$categories" />
<section id="products" class="w-full  mb-20 ">

    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold mt-4">Shopping Cart</h3>

    @if($cartItems->count() > 0)
    <!-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif -->

    <div class="flex justify-between items-center sm:flex-col-reverse md:flex-col-reverse lg:flex-row">
        <div class="lg:mt-10 lg:ml-40 lg:mr-20 lg:w-2/3 md:w-1/2 sm:w-1/2 ">

            @foreach($cartItems as $cartItem)
            <div id="product" class="sm:my-4 relative transition-transform duration-300 ease-in-out w-full flex lg:mb-10 p-10 shadow flex-col">
                <div class="absolute top-8 flex justify-center items-center right-2">
                <form action="{{ route('minusCart' ,['product' => $cartItem->product->id ]) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
                        <button type="submit" class="flex">
                            <li class="text-base   transition-transform duration-300 ease-in-out">
                                <a href="#" id="cartItem" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                                    <i class="ri-subtract-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                                </a>
                            </li>
                        </button>
                </form>
                <input type="text" name="" id="" readonly value="{{ $cartItem->count }}" class="border-none text-center w-2">

                <form x-data="{ disabled: {{ $cartItem->product->quantity->quantity <= 0 ? 'true' : 'false' }} }" action="{{ route('plusCart', ['product' => $cartItem->product->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">

                        <button type="submit" class="flex" :disabled="disabled" @mouseover="disabled && tooltip = true" @mouseout="tooltip = false">
                            <li class="text-base transition-transform duration-300 ease-in-out">
                                <a href="#" id="cartItem" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                                    <i class="ri-add-line text-white p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                                </a>
                            </li>
                        </button>

                        <div x-show="tooltip" class="tooltip" x-cloak>
                            Out of stock
                        </div>
                    </form>
                   
                </div>
                <form action="{{ route('deleteCart' ,['product' => $cartItem->product->id ]) }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
                    <button type="submit" class="flex">
                        <li class="text-base mr-4 absolute right-4 top-28 hidden transition-transform duration-300 ease-in-out">
                            <a href="#" id="cartItem" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                                <i class="ri-delete-bin-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                            </a>
                        </li>
                    </button>
                </form>
                <li class="text-base mr-4 absolute right-4 top-40 hidden transition-transform duration-300 ease-in-out">
                    <a href="#" id="cartItem" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                        <i class="ri-share-forward-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                    </a>
                </li>
                <img src="{{asset('images/product_01.jpg')}}" alt="" class="w-40 h-40 rounded">

                <div class="product_details flex bg-white flex-col ">

                    <h4 class="py-2 text-2xl ">{{$cartItem->product->name}}</h4>
                    <p class="py-2 text-base ">{!! nl2br(e($cartItem->product->description)) !!}</p>
                    <p class="py-2 text-base "><i class="fa-solid fa-indian-rupee-sign"></i> {{$cartItem->product->price}}</p>
                    @php
                    $itemPrice=$cartItem->product->price*$cartItem->count;
                    @endphp
                    <p class="py-2 text-base "><span>Total: </span><i class="fa-solid fa-indian-rupee-sign"></i> {{$itemPrice}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="lg:w-1/3 flex flex-col shadow p-10 lg:mr-10">
            <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">Cart Summary</h3>
            @foreach($cartItems as $cartItem)
            <div class="flex justify-between items-center">
                <p>{{$cartItem->product->name}}</p>
                <p><span>Total: </span><i class="fa-solid fa-indian-rupee-sign"></i> {{$itemPrice}}</p>
            </div>
            @endforeach

            @php
            $totalPrice = 0;
            foreach($cartItems as $cartItem) {
            $itemPrice = $cartItem->product->price * $cartItem->count;
            $totalPrice += $itemPrice;
            }
            @endphp

            <p class="pt-2 text-base border-b-2 border-black pb-4 "><span>Grand Total: </span><i class="fa-solid fa-indian-rupee-sign"></i> {{ $totalPrice }}</p>
            <div class="flex flex-col justify-center items-center py-4  border-b-2 border-black">
                <h3 class="pb-4">Apply a Promotion Code</h3>
                <form action="#" method="get" class="flex justify-between items-center">
                    <input type="text" name="" id="" readonly>
                    <button type="submit" class="border-2 border-black h-12 w-40 ml-4 flex justify-center items-center">Apply</button>
                </form>

                <!-- Place Order -->

                <a href="" id="popup" class="border-2 bg-black  my-4 flex justify-center items-center w-full tex-center text-white h-12 uppercase">Place Order</a>

                <p class="pb-2">By continuing to Checkout, you are agreeing to our <br><b>Terms of Use</b> and <b>Privacy Policy</b></p>
            </div>
            <div class="">
                <p class="py-2 text-center">Or use other checkout methods</p>
                <div class="flex">
                    <a href="" class="bg-yellow-400 w-full text-center h-10 py-2 my-2"><span class="italic text-blue-950 font-bold">Pay</span><span class="italic text-blue-400 font-bold">Pal</span></a>

                </div>
            </div>

        </div>
    </div>

    <div class="shadow transform transition-transform duration-300 ease-in-out bg-white p-10 lg:w-[50rem] md:w-[45rem] sm:w-[45rem] mb-10 z-[150000] fixed top-0 lg:right-40 md:right-20 hidden" id="popup-window">
        <h3>Are you sure you want to place the order?</h3>
        <p>Cancelling an order after it is placed is subjected to a cancellation fee</p>
        <p>Review the orders before proceeding</p>
        <div class="my-4">
            @foreach($cartItems as $cartItem)
            <div class="product_details flex mb-2 bg-white justify-between items-center">
                <img src="{{ asset('images/product_01.jpg') }}" alt="" class="w-12 h-12 rounded">
                <h4 class="text-xl ">{{ $cartItem->product->name }}</h4>

                <p class="text-base"><span>Price: </span><i class="fa-solid fa-indian-rupee-sign"></i> {{ $cartItem->product->price }}</p>
                <p class="text-base"><span>Count: </span> {{ $cartItem->count }}</p>

                @php
                $itemPrice = $cartItem->product->price * $cartItem->count;
                @endphp

                <p class="text-base"><span>Total: </span><i class="fa-solid fa-indian-rupee-sign"></i> {{ $itemPrice }}</p>
            </div>
            @endforeach
        </div>
        <div class="flex justify-between items-center">
            <a href="" class="border-2 border-black text-black font-bold text-center py-3 h-16 w-40 uppercase" id="cancel">Cancel</a>
            <form action="{{ route('checkout') }}" method="post">
                @csrf
                <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                <button type="submit">
                    <a href="" class="border-2 bg-secondary-color  text-white font-bold text-center flex justify-center items-center h-16 w-64 uppercase">Proceed To Checkout</a>
                </button>
            </form>

        </div>
    </div>
    @else
    <x-empty 
    src="{{ asset('icons/cart.png') }}"
     imageDimensions=""
     heading=""
     content="Looks like you haven't added anything to your cart yet"
     buttonContent="Start Shopping"/>
    @endif

    <x-paginator :products="$cartItems" />
</section>


<x-footer />

@endsection()