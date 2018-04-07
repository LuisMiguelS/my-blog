<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;

class AccessMiddleware
{
    /**
     * List of controllers to handle.
     *
     * @var array
     */
    protected $controllers = [
        TagController::class,
        RoleController::class,
        PostController::class,
        UserController::class,
        SettingController::class,
        CategoryController::class,
        DashboardController::class,
        PermissionController::class,
    ];
    /*
     * List of actions with their mapping name to handle.
     *
     * @var array
     */
    protected $actions = [
        'index'   => 'view',
        'edit'    => 'edit',
        'show'    => 'view',
        'update'  => 'edit',
        'create'  => 'add',
        'store'   => 'add',
        'destroy' => 'delete',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->IsNotController($request)) {
            return $next($request);
        }
        if ($this->NotShouldHandle($request)) {
            return $next($request);
        }
        if ($this->userHasPermission($request)) {
            return $next($request);
        }
        abort('401');
    }
    /**
     * Should the request be handled.
     *
     * @param $request
     * @return bool
     */
    protected function shouldHandle($request): bool
    {
        return $this->checkController($request) && $this->checkAction($request);
    }
    /**
     * Check if the controller should be handle.
     *
     * @param $request
     * @return bool
     */
    protected function checkController($request): bool
    {
        return collect($this->controllers)->contains(function ($item) use ($request) {
            return is_a($request->route()->getController(), $item);
        });
    }
    /**
     * Check if the action should be handle.
     *
     * @param $request
     * @return bool
     */
    protected function checkAction($request): bool
    {
        return collect($this->actions)->has($request->route()->getActionMethod());
    }
    /**
     * Get the permission name for the given request.
     *
     * @param $request
     * @return string
     */
    protected function getPermission($request)
    {
        $routeName = explode('.', $request->route()->getName());
        $action = $this->actions[$request->route()->getActionMethod()];
        return $action . '' . $this->getRouteName($routeName);
    }
    /**
     * @param $routeName
     * @return string
     */
    protected function getRouteName($routeName)
    {
        if (count($routeName) > 2){
            return $this->generatePermissionController($routeName);
        }
        return '_' . $routeName[0];
    }
    /**
     *
     * @param $request
     * @return bool
     */
    protected function isController($request): bool
    {
        return (bool) $request->route()->getName();
    }

    /**
     * @param $request
     * @return bool
     */
    protected function IsNotController($request): bool
    {
        return !$this->isController($request);
    }
    /**
     * @param $request
     * @return bool
     */
    protected function NotShouldHandle($request): bool
    {
        return !$this->shouldHandle($request);
    }
    /**
     * @param $request
     * @return mixed
     */
    protected function userHasPermission($request)
    {
        return auth()->user()->can($this->getPermission($request));
    }
    /**
     * @param $routeName
     * @return string
     */
    protected function generatePermissionController($routeName): string
    {
        $route = '';
        for ($i = 0; $i < (count($routeName) - 1); $i++) {
            $route = $route . '_' . $routeName[$i];
        }
        return $route;
    }

}