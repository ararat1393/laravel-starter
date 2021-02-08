<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

trait Validators
{
    /**
     * @var
     */
    public $validator;
    /**
     * @var array
     */
    protected $validatorMessages = [];

    /**
     * @var
     */
    private $validationErrors;

    /**
     * Setup validation scenario
     * @var string
     */
    private $scenario;

    /**
     * @param $scenario
     */
    public function setScenario( $scenario )
    {
        if( !is_string($scenario) ){
            throw new \Exception('The Scenario must be a string');
        }
        $this->scenario = $scenario;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        $validationRules = [];
        foreach ($this->rules() as $attribute => $rules){
            if( !array_key_exists($attribute,$validationRules) ){
                $validationRules[$attribute] = [];
            }
            if( is_array($rules) ){
                foreach ($rules as $key => $rule){
                    if( is_array($rule) ){
                        if( is_array($rule['on']) && in_array($this->scenario,$rule['on'])){
                            $validationRules[$attribute][] = $key;
                        }elseif (is_string($rule['on']) && $rule['on'] === $this->scenario){
                            $validationRules[$attribute][] = $key;
                        }
                    }else{
                        $validationRules[$attribute][] = $rule;
                    }
                }
            }else{
                $validationRules[$attribute][] = $rules;
            }
        }
        return $validationRules;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        $this->validator = Validator::make($this->attributes, $this->getRules(),$this->validatorMessages);
        $this->scenario = null;
        if ($this->validator->passes())
            return true;
        $this->validationErrors =  $this->validator->errors();
        return false;
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function getErrorsList(string $column = '')
    {
        $errors = new \stdClass();
        if( empty($column) ){
            foreach ($this->validationErrors->getMessages() as $key => $message){
                $errors->$key = $message[0];
            }
            return $errors;
        }
        return $this->validationErrors->get( $column );
    }

    /**
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}
