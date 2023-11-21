<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class ClientController extends SmartController
{
    use HasMVConnector;

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
   
    public function registerClient(Request $request) {
  
        $client = Client::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user = new User([
            'name' => $request->input('name'), 
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $client->users()->save($user);
    }
}
