<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PriorityLevel;
use App\Models\Segment;
use App\Models\User;
use App\Models\Stage;
use App\Models\Source;

use App\Services\ClientService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Scopes\defaults;
use App\Scopes\createClientAdmin;
use App\Providers\RouteServiceProvider;

class ClientController extends SmartController
{
    use HasMVConnector, defaults, createClientAdmin;
    public function __construct(Request $request, ClientService $service)
    {
        parent::__construct($request);
        $this->connectorService = $service;
        // $this->itemName = null;
        // $this->unauthorisedView = 'easyadmin::admin.unauthorised';
        // $this->errorView = 'easyadmin::admin.error';
        // $this->indexView = 'easyadmin::admin.indexpanel';
        // $this->showView = 'easyadmin::admin.show';
        // $this->createView = 'easyadmin::admin.form';
        // $this->editView = 'easyadmin::admin.form';
        // $this->itemsCount = 10;
        // $this->resultsName = 'results';
    }
   
    public function regsiteringNewClient(Request $request) {

       
        $client = Client::create([
        
            'name' => $request->input('client_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('client_address'),
            'email' => $request->input('email'),
            
        ]);

        $validatedDataForClientAdmin=[
            'name' => $request->input('admin_name'), 
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'client_id'=>$client->id,
        ];

        $user=$this->createClientAdmin($client->id,$validatedDataForClientAdmin);
        // $user = User::create([
        //     'name' => $request->input('admin_name'), 
        //     'email' => $request->input('email'),
        //     'phone' => $request->input('phone'),
        //     'password' => bcrypt($request->input('password')),
        //     'client_id'=>$client->id,
        // ]);

        // $user->assignRole('Client Admin');
        event(new Registered($user));
        $this->createDefaultSources($client);
        $this->createDefaultDesignations($client);
        $this->createDefaultTags($client);
        $this->createDefaultSegments($client);
        $this->createDefaultStages($client);
        $this->createDefaultPriorityLevel($client);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

    }

}
