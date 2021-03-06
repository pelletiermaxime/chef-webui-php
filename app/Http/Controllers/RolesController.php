<?php

class RolesController extends \Controller
{
    /**
     * List all roles
     * @return View
     */
    public function index()
    {
        $roles = Role::all();

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

        if ($role->messages != null) {
            return Redirect::route('roles.index')->withErrors($role->messages);
        }

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
        $inputs = Input::only(['name', 'description']);

        if (Input::get('action') == 'edit') { // Edit
            $role = Role::find($inputs['name']);
            $role->description = $inputs['description'];
        } else { // New role
            $role = Role::fromArray($inputs);
        }

        $successfulSave = $role->save();

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
        $role = Role::destroy($name);
        return Redirect::route('roles.index')->withSuccess($role->messages[0]);
    }
}
