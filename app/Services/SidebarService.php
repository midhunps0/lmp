<?php
namespace App\Services;

use Modules\Ynotz\EasyAdmin\Contracts\SidebarServiceInterface;

class SidebarService implements SidebarServiceInterface
{
    public function getSidebarData(): array
    {
        return [
            [

                'type' => 'menu_group',
                'title' => 'Access Control',
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showRoles(),
                'menu_items' => [
                    [
                        'type' => 'menu_item',
                        'title' => 'Users',
                        'route' => 'users.index',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showRoles()
                    ],
                    
                    [
                        'type' => 'menu_item',
                        'title' => 'Roles',
                        'route' => 'roles.index',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showRoles()
                    ],
                    [
                        'type' => 'menu_item',
                        'title' => 'Permissions',
                        'route' => 'permissions.index',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showPermissions()
                    ],
                    [
                        'type' => 'menu_item',
                        'title' => 'Role-wise Permissions',
                        'route' => 'roles.permissions',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showPermissions()
                    ],
                ]
            ],
    
            
            // [
            //     'type' => 'menu_section',
            //     'title' => 'Menu Group',
            //     'icon' => 'easyadmin::icons.gear',
            //     'show' => $this->showRoles(),
            //     'menu_items' => [
            //         [
            //             'type' => 'menu_item',
            //             'title' => 'Menu Item Two',
            //             'route' => 'home',
            //             'route_params' => [],
            //             'icon' => 'easyadmin::icons.plus',
            //             'show' => $this->showRoles()
            //         ],
            //     ]
            // ],
            [
                'type' => 'menu_item',
                'title' => 'Subscription Models',
                'route' => 'subscriptionmodels.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSystemAdmin()
            ],
            [
                'type' => 'menu_item',
                'title' => 'All Stages',
                'route' => 'stages.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSystemAdmin()
            ],
            [
                'type' => 'menu_item',
                'title' => 'All Segments',
                'route' => 'segments.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSystemAdmin()
            ],
            [
                'type' => 'menu_item',
                'title' => 'All Tags',
                'route' => 'tags.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSystemAdmin()
            ],
            [
                'type' => 'menu_item',
                'title' => 'All Sources',
                'route' => 'sources.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSystemAdmin()
            ],
            [
                'type' => 'menu_item',
                'title' => 'All Clients',
                'route' => 'clients.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSystemAdmin()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Branches',
                'route' => 'branches.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.view_on',
                'show' => $this->showAllBranches()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Leads',
                'route' => 'leads.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.view_on',
                'show' => $this->showLeads()
            ],
        ];
    }

    private function showArticles()
    {
        return auth()->check();
    }
    private function showRoles()
    {
        return auth()->check();
    }
    private function showPermissions()
    {
        return auth()->check();
    }
    private function showSystemAdmin()
    {
        return auth()->user()->hasPermissionTo('Administrative'); 
    }
    private function showAllBranches()
    {
        
        return auth()->user()->hasPermissionTo('Branch-Create');
       
    }
    private function showUsersPerClientes(){
        return auth()->user()->hasPermissionTo("User-Create");
    }

    private function showLeads(){
        return auth()->user()->hasPermissionTo("Lead-Create");
    }
}
?>
