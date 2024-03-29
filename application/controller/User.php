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


        if(Input_Core::getPost()){



            $sEmail = Field::post('email')->required()->validation('/@/i');
            $sPassword = Field::post('password')->required();

            $oLoginForm = new Form_Core(array($sEmail, $sPassword));


            if($oLoginForm->validate()){
                $oUser = new User_Model();
                $oUser->attr(['email' => $sEmail->value(), 'password' => $oUser->passwordSecure($sPassword->value())]);
                //var_dump($oUser);
                //var_dump($_SESSION);
                if($oUser->exists()){
                    Auth_Core::init()->auth($sEmail->value());
                    //var_dump($_SESSION);
                    header('Location: /');
                    exit();
                }

            }
            $this->template->errors = $oLoginForm->sErrors;
        }


        $this->view = 'login';
    }



    public function register(){

        if(Input_Core::getPost()){



            $sEmail = Field::post('email')->required()->validation('/@/i');
            $sPassword = Field::post('password')->required();
            $sConfirmPassword = Field::post('passwordconfirm')->required()->equalsTo('password');
            $sFirstName = Field::post('firstname');
            $sLastName = Field::post('lastname');

            $oLoginForm = new Form_Core(array($sEmail, $sPassword, $sConfirmPassword, $sFirstName, $sLastName));

            if($oLoginForm->validate()){
                $oUser = new User_Model();
                $oUser->attr(['email' => $sEmail->value(), 'password' => $oUser->passwordSecure($sPassword->value())]);
                if(!$oUser->exists()){
                    $oUser->add()
                          ->setType(Customer_Model::get()->setRegistrationDate(date('Y-m-d H:i:s')))
                          ->setEmail($sEmail->value())
                          ->setPassword($oUser->passwordSecure($sPassword->value()))
                          ->setFirstName($sFirstName->value())
                          ->setLastName($sLastName->value())
                          ->save();

                    header('Location: /user/login');
                    exit();
                }else{
                    $oLoginForm->sErrors .= 'User already exists in our system. <br />';
                }

            }
            $this->template->errors = $oLoginForm->sErrors;
        }

        $this->view = 'register';
    }

    public function update() {
        Auth_Core::init()->isAuth(true);
        if(Input_Core::getPost()) {

            $sEmail = Field::post('email')->required();
            $sFirstName = Field::post('firstname')->required();
            $sLastName = Field::post('lastname')->required();

            $oForm = new Form_Core(array($sEmail, $sFirstName, $sLastName));

            if($oForm->validate()){
                $oUser = new User_Model();

                $oUser->attr(['email' => $sEmail->value()]);
                if($oUser->exists()) {

                    $oUser->get($oUser->aData['user_id'])
                        ->setEmail($sEmail->value())
                        ->setFirstName($sFirstName->value())
                        ->setLastName($sLastName->value())
                        ->save();



                    $this->template->error = 'Update successful ';
                }
            }else{
                $this->template->errors = $oForm->sErrors;
            }

        }
        $this->view = 'account';
    }

    public function update_password() {
        Auth_Core::init()->isAuth(true);


         if(Input_Core::getPost()) {
            $sPassword = Field::post('password');
            $sConfirmPassword = Field::post('passwordconfirm')->equalsTo('password');

             $oForm = new Form_Core(array($sPassword, $sConfirmPassword));

             //var_dump($oForm);
             //var_dump($oForm->validate());

            if($oForm->validate()){

                $oUser = new User_Model();

                $oUser->attr(['email' => $_SESSION['user']]);
                //var_dump($oUser);
                if($oUser->exists()){
                    $oUser->get($oUser->aData['user_id'])
                          ->setPassword($oUser->passwordSecure($sPassword->value()))
                          ->save();
                    $this->template->error = 'Password change successful ';
                }

            }else{
                $this->template->errors = $oForm->sErrors;
            }
        }

        $this->view = 'account';
    }

    /**
     * @todo Move logic to Auth_Core class
     */
    public function logout(){
        unset($_SESSION);
        session_destroy();
        header('Location: /');
        exit();
    }

    public function index(){
        $this->account();
    }

    public function account(){
        Auth_Core::init()->isAuth(true);
        //$oAcl = new Acl_Core(ACL::ACL_CUSTOMER);


        $this->view = 'account';
    }

    public function dashboard(){

        $oUser = new User_Model();

        $oUser->attr(['email' => $_SESSION['user']]);

        $templateName = 'user_dashboard';

        if($oUser->aData['user_type'] == 'C'){
            //$templateName
        }else if($oUser->aData['user_type'] == 'O'){

           // header('Location: /owner/owner');
           // exit();

        }elseif($oUser->aData['user_type'] == 'M'){

            header('Location: /staff/manager');
            exit();
        }
        elseif($oUser->aData['user_type'] == 'S'){
            header('Location: /staff/staff');
            exit();
        }


        $this->template->user_total_spending = $oUser->aData['customer_spending_total'];
        $this->view = $templateName;
    }


} 