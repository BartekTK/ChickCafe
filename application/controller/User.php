<?php

/**
    The MIT License (MIT)

    Copyright (c) 2015 Bartlomiej Kliszczyk

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */

/**
 * @author Bartlomiej Kliszczyk
 * @date 12-02-2015
 * @version 1.0
 * @license The MIT License (MIT)
 */



class User_Controller extends Base_Controller{

    public function login(){
        $oLoginForm = new Form_Core('post');

        if($_POST){


            $sUsername = $oLoginForm->element('username')->required()->validation('rule');
            $sPassword = $oLoginForm->element('password')->required()->validation('rule');
            var_dump($_POST);

        }

        $this->template->errors = $oLoginForm->sErrors;
        $this->view = 'login';
    }

    public function register(){
        $oLoginForm = new Form_Core('post');

        if($oLoginForm->submit()){


            $sUsername = $oLoginForm->element('username')->required()->validation('rule');
            $sPassword = $oLoginForm->element('password')->required()->validation('rule');


        }

        $this->template->errors = $oLoginForm->sErrors;
        $this->view = 'register';
    }


} 