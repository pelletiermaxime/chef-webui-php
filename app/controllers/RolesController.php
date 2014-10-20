<?php

class RolesController extends BaseController
{
    public function index()
    {
        $roles = Role::lists();

        return View::make('roles/index')
            ->withRoles($roles)
        ;
    }

    public function show($name)
    {
        $role = Role::find($name);

        return View::make('roles/show')
            ->withRole($role)
        ;
    }

    public function create()
    {
        return View::make('roles/create');
    }

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

    public function destroy($name)
    {
        $role       = new Role;
        $role->name = $name;
        $role->delete();
        return Redirect::route('roles.index')->withSuccess("Role <b>$name</b> deleted.");
    }
}
