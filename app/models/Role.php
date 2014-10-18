<?php

class Role
{
    public $name;
    public $description;

    public static $rulesCreate = [
        'name' => [
            'required',
            'regex:/^[\.\-[:alnum:]_]+$/',
        ],
    ];

    /**
     * Validate role
     * @param  Object $role
     * @return Array  $messages Error messages
     */
    public function validate($role)
    {
        $messages = [];
        $validator = Validator::make((array) $role, self::$rulesCreate);

        if ($validator->fails()) {
            $messages = $validator->messages()->all();
        }
        return $messages;
    }

    public function save()
    {
        $messages = [];

        $role = new StdClass;
        $role->name        = $this->name;
        $role->description = $this->description;

        $messages = $this->validate($role);
        if (!empty($messages)) {
            return $messages;
        }

        try {
            Chef::post('/roles', $role);
            $messages[] = "Role saved successfully.";
        } catch (Exception $e) {
            $message = $this->saveParseException($e);
            $messages[] = "Error saving: " . $message;
        }
        return $messages;
    }

    private function saveParseException($e)
    {
        $status = $e->getCode();
        $message = $e->getMessage();
        if ($status == 409) {
            $message = "Role \"{$this->name}\" already exists.";
        }
        return $message;
    }

    public function delete()
    {
        Chef::delete("/roles/{$this->name}");
    }

    public static function find($name) {
        $chefRole = Chef::get("/roles/$name");

        $role = new Role;
        $role->name        = $chefRole->name;
        $role->description = $chefRole->description;

        return $role;
    }
}
