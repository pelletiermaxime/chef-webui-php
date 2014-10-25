<?php

class Role
{
    public $name;
    public $description;
    public $messages;
    public $exists = false;

    public static $rulesCreate = [
        'name' => [
            'required',
            'regex:/^[\.\-[:alnum:]_]+$/',
        ],
    ];

    public static function fromArray($inputs = [])
    {
        $role = new Role;
        $role->name        = $inputs['name'];
        $role->description = $inputs['description'];
        return $role;
    }

    public static function destroy($name)
    {
        $role       = new Role;
        $role->name = $name;
        $role->delete();
    }

    /**
     * Validate role
     * @param  stdClass $role
     * @return array    $messages Error messages
     */
    public function validate($role)
    {
        $messages  = [];
        $validator = Validator::make((array)$role, self::$rulesCreate);

        if ($validator->fails()) {
            $messages = $validator->messages()->all();
        }
        return $messages;
    }

    public function save()
    {
        $this->messages = $this->validate($this);
        if (!empty($this->messages)) {
            return false;
        }

        try {
            if ($this->exists) { // Edit
                Chef::put("/roles/{$this->name}", $this);
            } else { // New
                Chef::post('/roles', $this);
                $this->exists = true;
            }
            $this->messages[] = "Role saved successfully.";
        } catch (Exception $e) {
            $this->saveParseException($e);
            return false;
        }
        return true;
    }

    /**
     * @param  Exception $e
     * @return string    $message
     */
    private function saveParseException($e)
    {
        $status  = $e->getCode();
        $message = $e->getMessage();
        if ($status === 409) {
            $message = "Role \"{$this->name}\" already exists.";
        }
        $this->messages[] = "Error saving: " . $message;
    }

    public function delete()
    {
        Chef::delete("/roles/{$this->name}");
    }

    /**
     * @param  string $name Role name
     * @return Role|array   Role model or empty array if not found
     */
    public static function find($name)
    {
        $chefRole = Chef::get("/roles/$name");

        if (empty($chefRole->name)) {
            return [];
        }

        $role              = new Role;
        $role->name        = $chefRole->name;
        $role->description = $chefRole->description;
        $role->exists      = true;

        return $role;
    }

    public static function all()
    {
        $chefRole = Chef::get("/roles");
        return (array)$chefRole;
    }
}
