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

<div id="wrap">
    <div id="main" class="container clear-top">

        <div class="container">
            <h3>Dashboard</h3>

            <div>
                Total spendings: £<?php echo $user_total_spending ?>
                </br>
                Status:

                <?php

                if($user_total_spending > 1000 && $user_total_spending < 2000){
                    echo 'Silver <br />';
                    echo 'You need to spend £'.(2000 - $user_total_spending).' more to get Gold membership';
                }else if($user_total_spending > 2000 && $user_total_spending < 5000){
                    echo 'Gold <br />';
                    echo 'You need to spend £'.(5000 - $user_total_spending).' more to get Diamond membership';
                }else if($user_total_spending > 5000) {
                    echo 'Diamond <br />';
                }else{
                    echo 'You need to spend £'.(1000 - $user_total_spending).' more to get Silver membership';
                }

                ?>
            </div>

            <a class="btn btn-lg btn-primary btn-block" href="/order/view">My Orders</a>

        </div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>