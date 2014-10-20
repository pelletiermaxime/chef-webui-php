<?php

class RolesController extends BaseController
{
    /**
     * List all roles
     * @return View
     */
    public function index()
    {
        $roles = Role::lists();

        return View::make('roles/index')
            ->withRoles($roles)
        ;
    }

    /**
     * Show a specific role
     * @param  string $name Role name
     * @return View
     */
    public function show($name)
    {
        $role = Role::find($name);

        return View::make('roles/show')
            ->withRole($role)
        ;
    }

    /**
     * Show the create page
     * @return View
     */
    public function create()
    {
        return View::make('roles/create');
    }

    /**
     * Save the role
     * @return Redirect Either back with errors or to listing with success
     */
    public function store()
    {
        $input = Input::except(['_token']);

        $role = new Role;
        $role->name        = $input['name'];
        $role->description = $input['description'];
        $successfulSave    = $role->save();

        if ($successfulSave !== true) {
            return Redirect::back()->withErrors($role->messages)->withInput();
        }

        return Redirect::route('roles.index')->withSuccess($role->messages[0]);
    }

    /**
     * Delete the role
     * @param  string $name Role name
     * @return Redirect Back to index with success
     */
    public function destroy($name)
    {
        $role       = new Role;
        $role->name = $name;
        $role->delete();
        return Redirect::route('roles.index')->withSuccess("Role <b>$name</b> deleted.");
    }
}
