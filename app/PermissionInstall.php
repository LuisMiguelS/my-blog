<?php


namespace App;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionInstall extends Install
{
    protected $actions = [
        'index'   => 'view',
        'edit'    => 'edit',
        'show'    => 'view',
        'update'  => 'edit',
        'create'  => 'add',
        'store'   => 'add',
        'destroy' => 'delete',
    ];

    public function install()
    {
        $this->searchAvailableMethods(Route::getRoutes()->getRoutesByMethod());

        return 'Permisos Instalados Correctamente';
    }

    private function searchAvailableMethods($routes)
    {
        foreach ($routes as $method => $urls) {
            $this->urlRouteMethod($urls);
        }
    }

    private function urlRouteMethod($urls)
    {
        foreach ($urls as $url => $route) {
            $this->isAdminRouteMethod($route);
        }
    }

    private function isAdminRouteMethod($route)
    {
        if ($route->action['prefix'] === '/admin') {
            $this->createPermission($route->action);
        }
    }

    private function createPermission($action)
    {
        $permiso = $this->generatePermission($action);

        Permission::firstOrCreate(
            ['name' => $permiso], ['name' => $permiso]
        );
    }

    private function generatePermission($action)
    {
        $permissionExplode = explode('.', $action['as']);
        $index = count($permissionExplode) - 1;
        return  $this->actions[$permissionExplode[$index]].''. $this->renderPermission($permissionExplode);
    }

    private function renderPermission($permisoRender)
    {
        $maxIndex = count($permisoRender) - 2;
        $routeActionPermission = '';
        for ($index = 0; $index <= $maxIndex; $index++) {
            $routeActionPermission = $routeActionPermission . '_' . $permisoRender[$index];
        }
        return $routeActionPermission;
    }
}