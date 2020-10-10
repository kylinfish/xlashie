<?php
namespace App\Forms;

use Illuminate\Routing\Route;
use Illuminate\Validation\ValidationException;

class BaseForm
{
    protected $validation_rules;
    protected $validator;

    public function __construct(Route $route, $action_name = '')
    {
        if (!$action_name) {
            $action_name = explode('@', $route->getActionName())[1];
        }

        // 有指定屬於該 action_name 的 validation_rule 就自動指定
        if (property_exists($this, $action_name)) {
            $this->validation_rules = $this->{$action_name};
        }
    }

    /**
     * validate
     *
     * @return void
     * @thorws Illuminate\Validation\ValidationException
     */
    public function validate($input_data, bool $is_throw_exe = false)
    {
        $validator = \Validator::make($input_data, $this->validation_rules);

        if ($validator->fails()) {
            if ($is_throw_exe) {
                throw new ValidationException($validator, $validator->errors());
            }
            return $validator->errors();
        }
    }

    /**
     * setRules 手動指定 validation rule
     *
     * @param array $rules
     * @return void
     */
    public function setRules($rules)
    {
        $this->validation_rules = $rules;
    }
}
