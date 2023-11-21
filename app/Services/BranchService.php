<?php
namespace App\Services;

use App\Models\Branch;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;
use Modules\Ynotz\MediaManager\Services\EAInputMediaValidator;

class BranchService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Branch::class;
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
            'client' => [
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
        return "Branches";
    }

    protected function getIndexHeaders(): array
    {
        return $this->indexTable->addHeaderColumn(
            title: 'Branche Name',
            sort: ['key' => 'name'],
       
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        
        return $this->indexTable->addColumn(
            fields: ['name'],
            
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
            title: 'Create Branch',
            form: FormHelper::makeForm(
                title: 'Create Branch',
                id: 'form_branches_create',
                action_route: 'branches.store',
                success_redirect_route: 'branches.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Branch',
            form: FormHelper::makeEditForm(
                title: 'Edit Branch',
                id: 'form_branches_create',
                action_route: 'branches.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'branches.index',
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
                label: 'Branch Name',
                properties: ['required' => true],
            ),
            'address' => FormHelper::makeTextarea(
                key: 'address',
                label: 'Branch Address'
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
            'image' => FormHelper::makeImageUploader(
                key: 'image',
                label: 'Product Image',
                validations: [
                    'required'=>true
                ]
            )
        ];
    }

    private function getQuery()
    {
        $result =  $this->modelClass::userBranches();
        return $result;
        
        // // Example:
        // return $this->modelClass::query()->with([
        //     'author' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        // ]);
    }

    private function getBranches(){
        return $this->getQuery()->get();
    }

    public function getStoreValidationRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'image'=>['required']
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
        ];
    }

    public function processBeforeStore(array $data): array
    {

        $data['managing_person_id'] = auth()->user()->id;
        $data['client_id'] = auth()->user()->client_id;

        return $data;
    }

    public function processBeforeUpdate(array $data): array
    {
        $data['managing_person_id'] = auth()->user()->id;
        $data['client_id'] = auth()->user()->client_id;
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
                            
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('address'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('email'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('phone'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('image'),
                        ])
                    
                ]
            );
        return $layout->getLayout();
    }
    public function getFileFields()
    {
        return ['image'];
    }
}

?>
