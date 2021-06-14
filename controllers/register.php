<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 6/1/21
 * Time: 8:10 PM
 */


class Register
{

    public function registerUser()
    {
        echo 'register new user...';
    }

    public function registerUserTwo($id, $name)
    {

        echo 'register new user... '.  $id . $name;
    }

}