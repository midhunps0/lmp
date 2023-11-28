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
                'show' => $this->showStages()
            ],
            [
                'type' => 'menu_item',
                'title' => 'All Segments',
                'route' => 'segments.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSegments()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Tags',
                'route' => 'tags.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showTags()
            ],
            
            [
                'type' => 'menu_item',
                'title' => 'All Sources',
                'route' => 'sources.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showSources()
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
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showAllBranches()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Leads',
                'route' => 'leads.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showLeads()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Followups',
                'route' => 'followups.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.plus',
                'show' => $this->showFollowUps()
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
    private function showFollowUps(){
        return auth()->user()->hasPermissionTo("Followup-Create");
    }

    private function showSegments(){
        return auth()->user()->hasPermissionTo("Segment-Create");
    }

    private function showStages(){
        return auth()->user()->hasPermissionTo("Stage-Create");
    }

    private function showSources(){
        return auth()->user()->hasPermissionTo("Source-Create");
    }

    private function showTags(){
        return auth()->user()->hasPermissionTo("Tag-Create");
    }
}
?>
