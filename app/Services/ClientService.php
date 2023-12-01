<?php
namespace App\Services;

use App\Models\Client;
use App\Models\User;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\ShowPageData;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;
use App\Models\Segment;
use App\Models\Stage;
use App\Models\PriorityLevel;
use App\Scopes\createClientAdmin;

class ClientService implements ModelViewConnector {
    use IsModelViewConnector;

    use createClientAdmin;
    private $indexTable;
     
    public function __construct()
    {
        $this->modelClass = Client::class;
        $this->indexTable = new IndexTable();
        $this->selectionEnabled = true;

        // $this->idKey = 'id';
        // $this->selects = '*';
        // $this->selIdsKey = 'id';
        // $this->searchesMap = [];
        // $this->sortsMap = [];
        // $this->filtersMap = [
        //     'author' => 'user_id' // Example
        // ];
        // $this->orderBy = ['created_at', 'desc'];
        // $this->sqlOnlyFullGroupBy = true;
        // $this->defaultSearchColumn = 'name';
        // $this->defaultSearchMode = 'startswith';
        // $this->relations = [];
        // $this->selectionEnabled = false;
        // $this->downloadFileName = 'results';
    }

    protected function relations()
    {
       
        return [
            'users' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            
           
        ];
    }
    protected function getPageTitle(): string
    {
        return "Clients";
    }

    protected function getIndexHeaders(): array
    {
       
        return $this->indexTable->addHeaderColumn(
            title: 'Client Name',
            sort: ['key' => 'id'],
        )->addHeaderColumn(
            title: 'Managing Person',
           // filter: ['key' => 'author', 'options' => User::all()->pluck('name', 'id')]
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
       
        return $this->indexTable->addColumn(
            fields: ['name'],
            //link: ['route'=>'clients.show','key'=>'id'],
        )->addColumn(
            fields: ['name'],
            relation:'users',
        )
        ->addActionColumn(
            editRoute: $this->getEditRoute(),
            deleteRoute: $this->getDestroyRoute(),
        )->getRow();
    }

    public function getAdvanceSearchFields(): array
    {
        return [];
        // // Example:
        // return $this->indexTable->addSearchField(
        //     key: 'title',
        //     displayText: 'Title',
        //     valueType: 'string',
        // )
        // ->addSearchField(
        //     key: 'author',
        //     displayText: 'Author',
        //     valueType: 'list_string',
        //     options: User::all()->pluck('name', 'id')->toArray(),
        //     optionsType: 'key_value'
        // )
        // ->addSearchField(
        //     key: 'reviewScore',
        //     displayText: 'Review Score',
        //     valueType: 'numeric',
        // )
        // ->getAdvSearchFields();
    }

    public function getDownloadCols(): array
    {
        return [];
        // // Example
        // return [
        //     'title',
        //     'author.name'
        // ];
    }

    public function getDownloadColTitles(): array
    {
        return [
            // 'title' => 'Title',
            // 'author.name' => 'Author'
        ];
    }

    public function getCreatePageData(): CreatePageData
    {
        return new CreatePageData(
            title: 'Create Client',
            form: FormHelper::makeForm(
                title: 'Create Client',
                id: 'form_clients_create',
                action_route: 'clients.store',
                success_redirect_route: 'clients.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Client',
            form: FormHelper::makeEditForm(
                title: 'Edit Client',
                id: 'form_clients_create',
                action_route: 'clients.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'clients.index',
                items: $this->getEditFormElements(),
                label_position: 'top'
            ),
            instance: $this->getQuery()->where('id', $id)->get()->first()
        );
    }

    private function formElements(): array
    {
      
        return [
            'name' => FormHelper::makeInput(
                inputType: 'text',
                key: 'name',
                label: 'Client Name',
                properties: ['required' => true],
            ),
            'address'=>FormHelper::makeTextarea(
                key:'address',
                label:'Address',
                properties: ['required'=> true],
            ),
            'phone' => FormHelper::makeInput(
                inputType: 'text',
                key: 'phone',
                label: 'Contact Number',
                properties: ['required' => true],
            ),
            'email' => FormHelper::makeInput(
                inputType: 'text',
                key: 'email',
                label: 'Email Id',
                properties: ['required' => true],
            ),
        ];
    }

    private function getQuery()
    {
        return $this->modelClass::query()
        ->with([
        'users' => function ($query) {
            $query->select('name')
                ->whereHas('roles', function ($subquery) {
                    $subquery->where('name', 'Client Admin'); 
                });
        }
    ]);
        
        // return $this->modelClass::query()->
        // with([
        //     'users'=>function ($query) {
        //         $query->select('id', 'name')
        //         ->where('client_id',$query->id && !'branch_id');
        //     }
        // ]);
        // // Example:
        // return $this->modelClass::query()->with([

        //     'author' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        // ]);
    }

    public function getStoreValidationRules(): array
    {
       
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            
            //'managing_person' => ['required', 'string'],
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            
            //'managing_person' => ['required', 'string'],
        ];
    }

    public function processBeforeStore(array $data): array
    {

        return $data;
    }

    public function processBeforeUpdate(array $data): array
    {
        // // Example:
        // $data['user_id'] = auth()->user()->id;

        return $data;
    }

    public function processAfterStore($instance): void
    {
        //Do something with the created $instance
    }

    public function processAfterUpdate($oldInstance, $instance): void
    {
        //Do something with the updated $instance
    }

    public function buildCreateFormLayout(): array
    {
        
         $layout = (new ColumnLayout())
            ->addElements([
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('name'),
                            //(new ColumnLayout(width: '1/2'))->addInputSlot('managing_person'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('address'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('phone'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('email'),
                        ]),
                ]);
        return $layout->getLayout();
    }

    public function getShowPageData($id):ShowPageData
    {
        //return ['title' => Str::ucfirst($this->getModelShortName()), 'instance' => $this->getQuery()->get()->first() ];
        
        return new ShowPageData("Clients",Client::find($id));
    }
}

?>
