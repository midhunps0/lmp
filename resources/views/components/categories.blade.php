<x-nav>
<section id="categories" class=" sm:w-1/2 sm:flex-col  md:h-1/3 sm:h-1/3 md:bg-white sm:bg-white sm:border-none md:border-none sm:fixed md:fixed md:flex sm:flex sm:left-[-28px] md:left-[-28px]  md:px-10 sm:px-10 sm:top-[26rem] md:top-[26rem] sm:z-50 md:z-50  md:w-1/2 lg:top-0 md:flex-col md:justify-center md:items-center lg:flex lg:flex-row lg:justify-between lg:items-start lg:my-0 lg:mx-4 sm:mx-0  lg:py-8  lg:border-b-2 lg:border-light-bg-color lg:relative lg:w-full bg-white py-4 lg:px-28 flex justify-between items-center border-b-2 border-light-bg-color">
        @foreach($categories as $category)
            <div class="flex lg:justify-center md:justify-start sm:justify-start items-center lg:mb-0 md:mb-2 sm:mb-2 ">
                <a href="{{ route('showProducts',$category->id)}}">{{$category->name}}</a>
                <i class="ri-arrow-down-s-line pl-1 lg:flex md:hidden sm:hidden "></i>
            </div>
        @endforeach
</section>
</x-nav>