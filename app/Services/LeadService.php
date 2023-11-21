<?php
namespace App\Services;

use App\Models\Lead;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;

class LeadService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Lead::class;
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
        return [];
        // // Example:
        // return [
        //     'author' => [
        //         'search_column' => 'id',
        //         'filter_column' => 'id',
        //         'sort_column' => 'id',
        //     ],
        //     'reviewScore' => [
        //         'search_column' => 'score',
        //         'filter_column' => 'id',
        //         'sort_column' => 'id',
        //     ],
        // ];
    }
    protected function getPageTitle(): string
    {
        return "Leads";
    }

    protected function getIndexHeaders(): array
    {
        
        return $this->indexTable->addHeaderColumn(
            title: 'Lead Name',
            sort: ['key' => 'name'],
        )->addHeaderColumn(
            title: 'Lead Type',
            filter: ['key' => 'leadable_type', 'options' => Lead::distinct('leadable_type')->pluck('leadable_type')->toArray()],
        )->addHeaderColumn(
            title: 'Managing Person',
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        
        return $this->indexTable->addColumn(
            fields: ['name'],
        )->addColumn(
            fields: ['leadable_type'],
        )->addColumn(
            fields: ['user_id'],
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
            title: 'Create Lead',
            form: FormHelper::makeForm(
                title: 'Create Lead',
                id: 'form_leads_create',
                action_route: 'leads.store',
                success_redirect_route: 'leads.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Lead',
            form: FormHelper::makeEditForm(
                title: 'Edit Lead',
                id: 'form_leads_create',
                action_route: 'leads.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'leads.index',
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
            'name' => FormHelper::makeInput(
                inputType: 'text',
                key: 'name',
                label: 'Lead Name',
                properties: ['required' => true],
            ),
            'leadable_type' => FormHelper::makeInput(
                inputType: 'text',
                key: 'leadable_type',
                label: 'Type of Lead'
            ),
        ];
    }

    private function getQuery()
    {
        $result= $this->modelClass::userClientBranch();
        return $result;

        //return $this->modelClass::query();
        // // Example:
        // return $this->modelClass::query()->with([
        //     'author' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        // ]);
    }
    public function getAllLeads(){
        return $this->getQuery()->get();
    }

    public function getStoreValidationRules(): array
    {
        
        return [
            'name' => ['required', 'string'],
            'leadable_type' => ['required', 'string'],
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'name' => ['required', 'string'],
            'leadable_type' => ['required', 'string'],
        ];
    }

    public function processBeforeStore(array $data): array
    {
        // // Example:
        // $data['user_id'] = auth()->user()->id;

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
                            (new ColumnLayout(width: '1/2'))->addInputSlot('leadable_type'),
                        ])
                ]
            );
        return $layout->getLayout();
    }
}

?>
