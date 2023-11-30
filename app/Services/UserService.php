<?php
namespace App\Services;

use App\Models\Client;
use App\Models\User;
use App\Models\District;
use App\Models\Branch;
use App\Services\RoleService;
use Illuminate\Support\Facades\Hash;
use Modules\Ynotz\AccessControl\Models\Role;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\ShowPageData;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\AuditLog\Events\BusinessActionEvent;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;

class UserService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

  
    
    
    public function __construct()
    {
        $this->modelClass = User::class;
        $this->indexTable = new IndexTable();
        $this->selectionEnabled = false;
        
       
    }

    public function displayAccessibleRoles(){
        $allRoles = config('role.accessibleRoles');
        $accessibleRoles = [];
    
        foreach ($allRoles as $role => $roleValues) {
            if (auth()->user()->hasRole($role)) {
                $accessibleRoles = array_merge($accessibleRoles, $roleValues);
            }
        }
    
        return $accessibleRoles;
    }

   

    protected function relations()
    {
        return [
            'roles' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            
            'client'=>[
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            'branch'=>[
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ]
        ];
    }
    protected function getPageTitle(): string
    {
        return 'Users';
    }
    protected function getIndexHeaders(): array
    {
        
        return $this->indexTable->addHeaderColumn(
            title: 'Name',
            sort: ['key' => 'name']
        )->addHeaderColumn(
            title: 'Role',
            filter: ['key' => 'roles', 'options' => Role::pluck('name','id')],
        )
        ->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        return $this->indexTable->addColumn(
            fields: ['name'],
            //link:['route'=>'users.show','key'=>'id']
        )->addColumn(
            fields: ['name'],
            relation: 'roles',
        )->addActionColumn(
            editRoute: $this->getEditRoute(),
            deleteRoute: $this->getDestroyRoute()
        )->getRow();
    }

    public function getAdvanceSearchFields(): array
    {
        return $this->indexTable->addSearchField(
            key: 'name',
            displayText: 'Name',
            valueType: 'string',
        )->getAdvSearchFields();
        // return [
        //     'name' => [
        //         'key' => 'name',
        //         'text' => 'Name',
        //         'type' => 'string', // numeric|string|list_numeric|list_string
        //         'inputType' => 'text', // text|select
        //         // 'options' => [],
        //         // 'optionsType' => ''  // 'key_value' or 'value_only'
        //     ]
        // ];
    }

    public function getDownloadCols(): array
    {
        return [
            'id',
            'name',
            'roles.name'
        ];
    }

    public function getDownloadColTitles(): array
    {
        return [
            'roles.name' => 'Role'
        ];
    }

    public function getCreatePageData(): CreatePageData
    {
        return new CreatePageData(
            title: 'Users',
            form: FormHelper::makeForm(
                title: 'Create User',
                id: 'form_users_create',
                action_route: 'users.store',
                success_redirect_route: 'users.index',
                items: $this->getCreateFormElements(),
                label_position: 'side'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'users',
            form: FormHelper::makeEditForm(
                title: 'Edit User',
                id: 'form_users_create',
                action_route: 'users.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'users.index',
                items: $this->getEditFormElements(),
                label_position: 'side'
            ),
            instance: ($this->modelClass)::find($id)
        );
    }

    private function formElements(): array
    {
       return[
            FormHelper::makeInput(
                inputType: 'text',
                key: 'name',
                label: 'Name',
                properties: ['required' => true]
            ),
            FormHelper::makeInput(
                inputType: 'text',
                key: 'email',
                label: 'Email',
                properties: ['required' => true,]
            ),
            FormHelper::makeInput(
                inputType: 'text',
                key: 'password',
                label: 'Password',
                properties: ['required' => true,],
                formTypes: ['create']
            ),
            FormHelper::makeSelect(
                key: 'branch',
                label: 'Select Branch',
                options:Branch::where('client_id',auth()->user()->client_id)->get(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [BranchService::class, 'suggestList'],
                properties: [
                    'required' => true,
                ],
            ),
            FormHelper::makeSelect(
                key: 'roles',
                label: 'Role',
                options:$this->displayAccessibleRoles(),
                options_type: 'key_value',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [RoleService::class, 'suggestList'],
                properties: [
                    'required' => true,
                ],
            ),
        ];
        
    }

    private function getQuery()
    {

        $result= $this->modelClass::userClientBranch()->with([
            'roles' => function ($query) {
                $query->select('id', 'name');
            }
        ]);
        return $result;


         // if(auth()->user()->client_id){
        //     return $this->modelClass::query()
        //     ->where('client_id',auth()->user()->client_id)
        //     ->where('branch_id',auth()->user()->branch_id)
        //     ->with([
        //         'roles' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        //     ]);
        // }
        // else{
        //     return $this->modelClass::query()
        //     ->with([
        //         'roles' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        //     ]);
        // }
    }
    public function getAllUsers()
    {
        return $this->getQuery()->get();
    }
 
    public function getStoreValidationRules(): array
    {
        return [
            'name' => ['required', 'string'],
            // 'username' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'branch_id'=>['required'],
            'roles.*' => ['required'],

        ];
    }

    public function getUpdateValidationRules($id): array
    {
        $arr = $this->getStoreValidationRules();
        unset($arr['password']);
        return $arr;
    }

    public function processBeforeStore(array $data): array
    {
       if(auth()->user()->client_id){
        $data['client_id']=auth()->user()->client_id;
        $data['branch_id']=auth()->user()->branch_id;
       }

        return $data;
    }

    // public function processBeforeUpdate(array $data): array
    // {
    //     $data['district_id'] = $data['district'];
    //     unset($data['district']);

    //     return $data;
    // }

    public function processAfterStore($instance): void
    {
        BusinessActionEvent::dispatch(
            User::class,
            $instance->id,
            'Created',
            auth()->user()->id,
            null,
            $instance,
            'Created User: '.$instance->name.', id: '.$instance->id,
        );
    }

    public function processAfterUpdate($oldInstance, $instance): void
    {
        BusinessActionEvent::dispatch(
            User::class,
            $instance->id,
            'Updated',
            auth()->user()->id,
            $oldInstance,
            $instance,
            'Updated User: '.$instance->name.', id: '.$instance->id,
        );
    }
    public function getShowPageData($id):ShowPageData
    {
        return new ShowPageData("User",User::find($id));
    }

   
}

?>
