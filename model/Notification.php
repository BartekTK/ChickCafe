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

interface Notification_Interface{
    public function get($iId);
    public function getByOrderId($iId);
}

class Notification_Model extends Foundation_Model implements Notification_Interface{


    public function sendMsgToUserType($sUserType, $sMsg, $sNotificationType = 'N'){

        try{


            $sQuery = 'INSERT INTO notification(notification_date, notification_type, notification_msg, notification_user_id, notification_user_type)
                        VALUES(NOW(), :ntype, :nmsg, NULL, :utype)';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':ntype', $sNotificationType);
            $oStmt->bindValue(':nmsg', $sMsg);
            $oStmt->bindValue(':utype', $sUserType);

            $oStmt->execute();



        }catch(Exception $e){

        }

    }

    public function setMsgToUserId($iUserId, $sMsg, $sNotificationType = 'N'){

        try{


            $sQuery = 'INSERT INTO notification(notification_date, notification_type, notification_msg, notification_user_id, notification_user_type)
                        VALUES(NOW(), :ntype, :nmsg, :iid, NULL)';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->bindValue(':ntype', $sNotificationType);
            $oStmt->bindValue(':nmsg', $sMsg);
            $oStmt->bindValue(':iid', $iUserId);

            $oStmt->execute();



        }catch(Exception $e){

        }
    }

    public function getById($iUserId, $sUserType = 'C'){

        $withUserType = '';

        if($sUserType != 'C'){
            $withUserType = ' OR notification_user_type = "'.$sUserType.'" ';
        }

        $sQuery = 'SELECT * FROM notification WHERE notification_user_id = :usr_id '.$withUserType.' ORDER BY notification_id DESC';
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->bindValue(':usr_id', $iUserId);

        $sExecute = $oStmt->execute();

        return $oStmt->fetchAll(PDO::FETCH_ASSOC);


    }

    public function getByType($sType){
        $sQuery = 'SELECT * FROM notification WHERE notification_user_type = :usr_type ORDER BY notification_id DESC';
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->bindValue(':usr_type', $sType);

        $sExecute = $oStmt->execute();

        return $oStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($iId){

    }
    public function getByOrderId($iId){

    }

    public function markAsRead($iNotificationId){
        $sQuery = 'UPDATE notification SET notification_read = 1 WHERE notification_id = :notification_id';
        $oStmt = $this->db->prepare($sQuery);
        $oStmt->bindValue(':notification_id', $iNotificationId);

        $sExecute = $oStmt->execute();
    }

} 