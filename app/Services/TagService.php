<?php
namespace App\Services;

use App\Models\Tag;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;

class TagService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Tag::class;
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
        return "Tags";
    }

    protected function getIndexHeaders(): array
    {
       
        return $this->indexTable->addHeaderColumn(
            title: 'Tags',
            sort: ['key' => 'tags'],
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        
        return $this->indexTable->addColumn(
            fields: ['tags'],
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
            title: 'Create Tag',
            form: FormHelper::makeForm(
                title: 'Create Tag',
                id: 'form_tags_create',
                action_route: 'tags.store',
                success_redirect_route: 'tags.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Tag',
            form: FormHelper::makeEditForm(
                title: 'Edit Tag',
                id: 'form_tags_create',
                action_route: 'tags.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'tags.index',
                items: $this->getEditFormElements(),
                label_position: 'top'
            ),
            instance: $this->getQuery()->where('id', $id)->get()->first()
        );
    }

    private function formElements(): array
    {
        
        return [
            'tags' => FormHelper::makeInput(
                inputType: 'text',
                key: 'tags',
                label: 'Tag',
                properties: ['required' => true],
            )
        ];
    }

    private function getQuery()
    {
        return $this->modelClass::query()->DisplayClientSpecificValues();
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
            'tags' => ['required', 'string'],
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'tags' => ['required', 'string'],
        ];
    }

    public function processBeforeStore(array $data): array
    {
        $data['client_id'] = auth()->user()->client_id;
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
                            (new ColumnLayout(width: '1/2'))->addInputSlot('tags'),
                            
                        ])
                ]
            );
        return $layout->getLayout();
    }
}

?>
