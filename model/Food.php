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



class Food_Model extends Foundation_Model implements Foundation_Interface{

    public $iFoodId;
    public $data;

    public function all(){
        try{
            $sQuery = 'SELECT * FROM item';

            $oStmt = $this->db->prepare($sQuery);
            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){
            var_dump($e);
        }
    }



    public function create($sName){

    }

    public function get($iId){

        try{

            $sQuery = 'SELECT * FROM item WHERE item_id = :id';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':id', $iId);
            $oStmt->execute();

            $this->data = $oStmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){

        }



        return $this;
    }

    public function in($iItemId, $iIngredientId){
        try{

            $sQuery = 'SELECT * FROM item_ingredients WHERE ingredient_id = :ing_id AND item_id = :it_id';
            $oStmt = $this->db->prepare($sQuery);

            $oStmt->bindValue(':ing_id', $iIngredientId);
            $oStmt->bindValue(':it_id', $iItemId);

            $oStmt->execute();

            return $oStmt->fetchAll(PDO::FETCH_ASSOC);


        }catch(Exception $e){

        }
    }

    public function addIngredient($iItemId, $iIngredientId){
        try{

            if(empty($this->in($iItemId, $iIngredientId))){
                $sQuery = 'INSERT INTO item_ingredients(ingredient_id, item_id) VALUES(:ing_id, :it_id)';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();
            }else{
                $sQuery = 'UPDATE item_ingredients SET ingredient_quantity = ingredient_quantity+1 WHERE ingredient_id = :ing_id AND item_id = :it_id';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();
            }




        }catch(Exception $e){

        }
    }

    public function removeIngredient($iItemId, $iIngredientId){
        try{


            if(empty($this->in($iItemId, $iIngredientId))) {

                $sQuery = 'DELETE FROM item_ingredients WHERE ingredient_id = :ing_id AND item_id = :it_id';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();

            }else{
                $sQuery = 'UPDATE item_ingredients SET ingredient_quantity = ingredient_quantity-1 WHERE ingredient_id = :ing_id AND item_id = :it_id';
                $oStmt = $this->db->prepare($sQuery);

                $oStmt->bindValue(':ing_id', $iIngredientId);
                $oStmt->bindValue(':it_id', $iItemId);

                $oStmt->execute();
            }


        }catch(Exception $e){

        }
    }

} 