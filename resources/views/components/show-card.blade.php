<div class="flex text-center justify-center items-center">
    <div class="uppercase p-2 font-bold text-lg ">{{$instance->name}}</div>
    <div class="p-2 bg-green-700 shadow w-40 h-40 z-10">{{$instance->subscriptionModel->model}} Client</div>
</div>
<div class="p-4 text-base">{{$instance->address}}</div>
<div class="flex text-center mx-auto py-2 ">Contact Number: <div class="font-bold pl-2">{{$instance->phone}}</div></div>
<div class="flex text-center mx-auto py-2 ">Email Id: <div class="font-bold pl-2">{{$instance->email}}</div></div>
<div class="flex text-center mx-auto py-2">Managing Person: <div class="font-bold pl-2"><a href="">{{$instance->managingPerson->name}}</a></div></div>