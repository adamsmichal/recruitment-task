<?php

namespace blog;

use blog;

class Validator
{
    private bool $_passed = false;
    private array $_errors = array();
    private ?Database $_database = null;

    public function __construct()
    {
        $this->_database = Database::getInstance();
    }

    //check the rules and return an error if the input values break the rules
    public function check($source, $items = array())
    {
        //items is an array of rules which we declare in form file
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                //input value
                $value = trim($source[$item]);

                //rules checking
                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                        case 'unique':
                            $check = Database::getInstance();
                            $check->get($rule_value, array($item, '=', $value));
                            if($check->count()) {
                                $this->addError("{$value} already exists.");
                            }
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}