<?php
namespace App\Services;

use App\Models\Action;
use App\Models\Followup;
use App\Models\Lead;
use App\Models\User;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;
use Carbon\Carbon;

class FollowupService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Followup::class;
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
            'lead' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            'createdBy' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            'CarriedOutBy' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],

        ];
        //     'reviewScore' => [
        //         'search_column' => 'score',
        //         'filter_column' => 'id',
        //         'sort_column' => 'id',
        //     ],
        // ];
    }
    protected function getPageTitle(): string
    {
        return "Followups";
    }

    protected function getIndexHeaders(): array
    {
        
        return $this->indexTable->addHeaderColumn(
            title: 'Lead Name',
            sort: ['key' => 'lead_id'],
        )->addHeaderColumn(
            title: 'Created By',
        )->addHeaderColumn(
            title: 'Carried Out By',               
        )->addHeaderColumn(
            title: 'Scheduled Date',
            
        )->addHeaderColumn(
            title: 'Actual Date',
        )->addHeaderColumn(
                title: 'Next Followup Date',
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        
        return $this->indexTable->addColumn(
            fields: ['name'],
            relation:'lead'
        )->addColumn(
            fields:['name'],
            relation:'createdBy'
        )->addColumn(
            fields:['name'],
            relation:'carriedOutBy'
        )->addColumn(
            fields: ['scheduled_date'],
        )->addColumn(
            fields: ['actual_date'],
        )->addColumn(
            fields: ['next_followup_date'],
      
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
            'title' => 'Title',
            'author.name' => 'Author'
        ];
    }

    public function getCreatePageData(): CreatePageData
    {
        return new CreatePageData(
            title: 'Create Followup',
            form: FormHelper::makeForm(
                title: 'Create Followup',
                id: 'form_followups_create',
                action_route: 'followups.store',
                success_redirect_route: 'followups.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Followup',
            form: FormHelper::makeEditForm(
                title: 'Edit Followup',
                id: 'form_followups_create',
                action_route: 'followups.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'followups.index',
                items: $this->getEditFormElements(),
                label_position: 'top'
            ),
            instance: $this->getQuery()->where('id', $id)->get()->first()
        );
    }

    /*
    public function getShowPageData($id): ShowPageData
    {
        return new ShowPageData(
            Str::ucfirst($this->getModelShortName()),
            $this->getQuery()->where($this->key, $id)->get()->first()
        );
    }
    */

    private function formElements(): array
    {
       
        return [
            'lead_id'=>FormHelper::makeSelect(
                key: 'lead_id',
                label: 'Choose Lead',
                options:Lead::where('client_id',auth()->user()->client_id)->get(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [LeadService::class, 'suggestList'],
                properties: [
                    'required' => true,
                ],
                formTypes:['create']
            ),
            'action_id'=>FormHelper::makeSelect(
                key: 'action_id',
                label: 'Choose Action',
                options:Action::where('client_id',auth()->user()->client_id)->get(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [ActionService::class, 'suggestList'],
                properties: [
                    'required' => true,
                ],
            ),
            'carried_out_by'=>FormHelper::makeSelect(
                key: 'carried_out_by',
                label: 'Carried Out By',
                options:User::where('client_id',auth()->user()->client_id)->get(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [ActionService::class, 'suggestList'],
                properties: [
                    'required' => true,
                ],
            ),
            'scheduled_date'=>FormHelper::makeDatePicker(
                key:'scheduled_date',
                label:'Scheduled Date',
                startYear:2023,
                dateFormat:'YYYY-MM-DD',
                properties:[
                    'required'=> true
                ]
            ),
            'actual_date'=>FormHelper::makeDatePicker(
                key:'actual_date',
                label:'Actual Date',
                startYear:2023,
                dateFormat:'YYYY-MM-DD',
                properties:[
                    'required'=> true
                ]
            ),
            'next_followup_date'=>FormHelper::makeDatePicker(
                    key:'next_followup_date',
                    label:'Next Followup Date',
                    startYear:2023,
                    dateFormat:'YYYY-MM-DD',
                    properties:[
                        'required'=> true
                    ]
            )
        ];
    }

    private function getQuery()
    {
        return $this->modelClass::query()
        ->where('created_by',auth()->user()->id)
        ->with([
            'lead'=>function($query){
                $query->select('id', 'name');
            }
        ]);
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
            'lead_id' => ['required'],
            'action_id' => ['required'],
            'scheduled_date' => ['required'],
            'actual_date' => ['required'],
            'next_followup_date' => ['required'],
            'carried_out_by'=>['required']
            
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
        'action_id' => ['required'],
        'scheduled_date' => ['required'],
        'actual_date' => ['required'],
        'next_followup_date' => ['required'],
        'carried_out_by'=>['required']
        ];
    }

    public function processBeforeStore(array $data): array
    {
        // // Example:
        $data['created_by'] = auth()->user()->id;

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
                            (new ColumnLayout(width: '1/2'))->addInputSlot('lead_id'),
                            
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('action_id'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('carried_out_by'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('scheduled_date'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('actual_date'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('next_followup_date'),
                        ])
                ]
            );
        return $layout->getLayout();
    }

}

?>
