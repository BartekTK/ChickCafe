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

abstract class ACL{
    /**
     * No restrictions
     */
    const ACL_PUBLIC = 0;

    /**
     * Customer
     */
    const ACL_CUSTOMER = 'C';

    /**
     * Staff
     */
    const ACL_STAFF = 'S';

    /**
     * Admin
     */
    const ACL_ADMIN = 'A';

    /**
     * Manager
     */
    const ACL_MANAGER = 'M';

    /**
     * Owner
     */
    const ACL_OWNER = 'O';
}

interface Acl_Interface{
    public static function init();
    public function setAccess($aAccess);
}

class Acl_Core implements Acl_Interface{

    public static function allow($aclList){

        $oUser = new User_Model();
        $email = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $oUser->attr(['email' => $email]);

        return in_array($oUser->aData['user_type'], $aclList);

    }

    public static function init()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self(null);
        }

        return $instance;
    }

    public function __construct($accessControlList = null){
        $this->validate($this->usersType(), $accessControlList);
    }

    private function usersType(){
        $oUser = new User_Model();
        $email = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $oUser->attr(['email' => $email]);

        return $oUser->aData['user_type'];
    }

    private function validate($userType, $access){
        if($userType != $access){
            header('Location: /error403'); //Forbidden
            exit();
        }
    }

    public function setAccess($aAccess){

    }

} 