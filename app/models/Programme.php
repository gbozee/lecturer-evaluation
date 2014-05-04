<?php
/**
 * Created by PhpStorm.
 * User: gbozee
 * Date: 4/19/14
 * Time: 1:50 PM
 */

class Programme extends \Eloquent {
    protected $fillable = ['name','department'];

    public static $rules = [
        'name' => 'required',
        'department' => 'required'
    ];
    public $errors;

    public function students(){
        return $this->hasMany('User','user_id');
    }

    public function isValid(){
        $validation = Validator::make($this->attributes,static::$rules);

        if($validation->passes()){
            return true;
        }
        $this->errors = $validation->messages();
        return false;
    }
}