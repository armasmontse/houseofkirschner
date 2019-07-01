<?php

namespace Illuminate;

use Illuminate\Contracts\Controller as ControllerContract;
use ReflectionClass;

abstract class Controller implements ControllerContract
{
    public function handle()
    {
        return $this->store($_POST);
    }

    public function validate($input, $validation)
    {
        foreach($validation as $field => $rules){

            $rules = explode('|', $rules);
    
            foreach($rules as $rule){
    
                if(!$this->rule($rule, $field, $input)){
    
                    $this->returnError();
    
                }
    
            }
    
        }
    }

    public function rule($rule, $field, $input)
    {
        if($rule == 'required'){
            return array_key_exists($field, $input) && !empty($input[$field]);
        }
    }

    public function error()
    {
        if ( wp_get_referer() ) { 
            wp_safe_redirect( wp_get_referer() );
        } else {
            wp_safe_redirect( get_home_url() );
        }
    }

    public function success($link)
    {
        wp_safe_redirect($link);
    }

    public function registerController()
    {
        $class = new ReflectionClass($this);

        $name = toSnakeCase( str_replace('Controller', '', $class->getShortName()) );

        add_action( 'admin_post_nopriv_' .  $name, [ $this , 'handle'] );
        add_action( 'admin_post_' . $name, [ $this , 'handle'] );
    }

    // Static

    // $classname = get_called_class();

    // $shortname = basename(str_replace('\\', '/',  $classname));

    // $name = toSnakeCase( str_replace('Controller', '', $shortname) );

    // add_action( 'admin_post_nopriv_' .  $name, [ $classname , 'handle'] );
    // add_action( 'admin_post_' . $name, [ $classname , 'handle'] );
}