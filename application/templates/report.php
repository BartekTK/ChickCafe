{include file=header.php}


<div class="container">
    <br />
    <br />
    <div class="row">
        
        <div class="col-md-12 well admin-content" id="home">


            <script type="text/javascript">
                $('#staff_tab a').click(function (e) {
                    e.preventDefault()
                    $(this).tab('show')
                })

            </script>

            <div id="wrap">
                <div id="main" class="container clear-top">
                    <?php if(Acl_Core::allow([ACL::ACL_MANAGER,ACL::ACL_OWNER,ACL::ACL_ADMIN])){
                        echo '<a class="btn btn-lg btn-primary" href="/staff/staff">Staff Dashboard</a>';
                        echo '<a class="btn btn-lg btn-primary" href="/staff/manager">Manager Dashboard</a>';
                    } else {

                    } ?>

                    <?php if (Acl_Core::allow([ACL::ACL_OWNER])) {
                        echo '<a class="btn btn-lg btn-primary" href="/owner/owner_backup">Backup/Restore Database</a>';
                    }?>
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-pills" id="staff_tab" role="tablist">
                            <li role="presentation" class="active"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Orders processed</a></li>
                            <li role="presentation"><a href="#spending" aria-controls="spending" role="tab" data-toggle="tab">Customer spending report</a></li>
                            <li role="presentation"><a href="#refunds" aria-controls="refunds" role="tab" data-toggle="tab" >Refunds processed</a></li>
                            <li role="presentation"><a href="#stock" aria-controls="stock" role="tab" data-toggle="tab" >Stock report</a></li>
                            <li role="presentation"><a href="#unprocess" aria-controls="stock" role="tab" data-toggle="tab" >Customers and Unprocessed Orders </a></li>
                            <li role="presentation"><a href="#performance" aria-controls="stock" role="tab" data-toggle="tab" >Staff Performance</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="orders">
                                <h2>Orders processed in the last 3 months</h2>
                                <table class="table">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Order Price</th>
                                        <th>Order Date</th>
                                        <th>Order Items</th>
                                        <th>Order Priority</th>
                                        <th>Order Type</th>
                                        <th>Order Staff ID</th>
                                        <th>Refund ID</th>
                                    </tr>
                                    {foreach($orders as $key => $value)}
                                    <tr class="info">
                                        <td>{! $value['order_id']}</td>
                                        <td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
                                        <td>{! $value['user_id']}</td>
                                        <td>{! $value['order_price']}</td>
                                        <td>{! $value['order_datetime']}</td>
                                        <td><?php
                                            echo implode($value['item_names'], ', ');
                                            ?></td>
                                        <td>{! $value['order_priority']}</td>
                                        <td>{! $value['order_type']}</td>
                                        <td>{! $value['order_staff_id']}</td>
                                        <td>{! $value['refund_refund_id']}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="spending">
                                <h2>Customer spending table</h2>
                                <table class="table">
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Total Spent by Customer</th>
                                    </tr>
                                    {foreach($customer_spending as $key => $value)}
                                    <tr class="info">
                                        <td>{! $value['user_id']}</td>
                                        <td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
                                        <td>{! $value['customer_spending_total']}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="refunds">
                                <h2>Refunds processed (and by which Manager)</h2>
                                <table class="table">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Refund ID</th>
                                        <th>Order Date</th>
                                        <th>Refund Date</th>
                                        <th>Order Staff ID</th>
                                        <th>Order/Refund Amount</th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Staff ID</th>
                                    </tr>
                                    {foreach($refunds as $key => $value)}
                                    <tr class="info">
                                        <td>{! $value['order_id']}</td>
                                        <td>{! $value['refund_refund_id']}</td>
                                        <td>{! $value['order_datetime']}</td>
                                        <td>{! $value['refund_date']}</td>
                                        <td>{! $value['order_staff_id']}</td>
                                        <td>{! $value['refund_amount']}</td>
                                        <td>{! $value['user_id']}</td>
                                        <td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
                                        <td>{! $value['refund_staff_id']}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="stock">
                                <h2>Ingredient Stock Report</h2>
                                <table class="table">
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Ingredient Name</th>
                                        <th>Item Price</th>
                                        <th>Ingredient ID</th>
                                        <th>Ingredient Stock</th>
                                    </tr>
                                    {foreach($stock as $key => $value)}
                                    <tr class="info">
                                        <td>{! $value['item_id']}</td>
                                        <td>{! $value['item_name']}</td>
                                        <td>{! $value['ingredient_name']}</td>
                                        <td>{! $value['item_price']}</td>
                                        <td>{! $value['ingredient_id']}</td>
                                        <td>{! $value['ingredient_stock']}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane active" id="unprocess">
                                <h2>Logged in customers and unprocessed orders report</h2>
                                <table class="table">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Order Price</th>
                                        <th>Order Date</th>
                                        <th>Order Items</th>
                                        <th>Order Priority</th>
                                        <th>Order Type</th>
                                        <th>Order Staff ID</th>
                                        <th>Order Ready?</th>
                                    </tr>
                                    {foreach($today_order as $key => $value)}
                                    <tr class="info">
                                        <td>{! $value['order_id']}</td>
                                        <td>{! $value['user_firstname']} {! $value['user_lastname']}</td>
                                        <td>{! $value['user_id']}</td>
                                        <td>{! $value['order_price']}</td>
                                        <td>{! $value['order_datetime']}</td>
                                        <td><?php
                                            echo implode($value['item_names'], ', ');
                                            ?></td>
                                        <td>{! $value['order_priority']}</td>
                                        <td>{! $value['order_type']}</td>
                                        <td>{! $value['order_staff_id']}</td>
                                        <td>{! $value['order_ready']}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane active" id="performance">
                                <h2>Staff Performance Report</h2>
                                <table class="table">
                                    <tr>
                                        <th>Staff ID</th>
                                        <th>Staff Name</th>
                                        <th>Orders Processed</th>
                                        <th>Average Prep Time</th>
                                        <th>Money Taken</th>
                                    </tr>
                                    {foreach ($performance as $key => $value)}
                                    <tr class="info">
                                        <td>{! $value['staff_user_id']}</td>
                                        <td>{! $value['staff_name']}</td>
                                        <td>{! $value['orders_made']}</td>
                                        <td>{! $value['item_total_prep']}</td>
                                        <td>£{! $value['order_value']}</td>
                                    </tr>
                                    {/foreach}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!--- admin end -->

    </div>
</div>

<br />
<br />
<br />
<br />
<br />
<br />




{include file=footer.php}