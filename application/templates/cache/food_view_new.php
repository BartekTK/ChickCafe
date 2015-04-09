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

 ?>


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>



<div class="container-fluid main">


    <div class="container">
        <legend>
            <span style="color: red;"><i class="fa fa-exclamation-triangle"></i></span> - Available stock is empty
            <span style="color: orange;"><i class="fa fa-exclamation-triangle"></i></span> - Available stock is low (less than 15%)
        </legend>


        <a class="btn btn-sm btn-primary" href="/ingredients/view">Ingredients list</a>
        <div class="row">
            <?php foreach($all as $key => $value): ?>
            <a href="/menu/view/id/<?php echo $value['item_id'] ?>">


                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="box" style="background: white">
                        <div class="box-image" style="background: url(/food_images/<?php echo $value['item_img'] ?>)">
                        </div>
                        <div class="info" style="padding: 10px 25px;">
                            <div class="box-icon">
                                <img style="width: 100%; height: 100%;border-radius: 50%;" src="/food_images/<?php echo $value['item_img'] ?>">
                            </div>
                            <h4 class="text-center"><span style="<?php if($value['item_available'] == 0) echo 'color: red'; elseif((($value['item_available'] / $value['item_stock']) * 100) < 15)  echo 'color: orange'; else echo 'display: none' ?>"><i class="fa fa-exclamation-triangle"></i></span><?php echo $value['item_name'] ?></h4>
                            <p class="text-center" style="color: #000000"><?php  echo  $value['item_description'] ?></p>

                            <div class="well index">
                            <div class="text-left">
                            <p style="color: #000000">Stock: <?php echo $value['item_stock'] ?></p>
                            <p style="color: #000000">Available in stock: <?php echo $value['item_available'] ?></p>
                            <p style="color: #000000">Price: <?php echo $value['item_price'] ?></p>
                            <p style="color: #000000">Preparation time: <?php echo $value['item_preptime'] ?></p>
                            <p style="color: #000000">Ingredients:</p>
                            </div>
                            </div>
                            <ul class="well">
                                <?php $oIngredientsList = $oIngredients->ingredients($value['item_id']); ?>
                                <?php if(empty($oIngredientsList)) echo 'None'; ?>
                                <div style="float: none; list-style: none">
                                    <?php foreach($oIngredientsList as $k => $v): ?>
                                    <p class="text-left" style="color: #000000">
                                        <?php echo $v['ingredient_name'] ?> [ <?php echo $v['ingredient_quantity'] ?> ]
                                    </p>
                                    <?php endforeach; ?>
                                </div>
                            </ul>
                            <a class="btn btn-sm" href="/food/edit/id/<?php echo $value['item_id'] ?>">Edit</a>
                        </div>
                    </div>
                </div>

            </a>
            <?php endforeach; ?>
        </div>
    </div>




</div>


<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>