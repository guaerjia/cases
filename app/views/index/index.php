<?php require APP_PATH . '/app/views/header.php'; ?>

    <?php 
    if ( isset($this->user_id) ) {
    ?>
    <div class="jumbotron">
      <div class="container">
        
        <p>UserId:<?php echo $this->user_id;?></p>
        
      </div>
    </div>
    <?php 
    }
    ?>

    <div class="container">

	<br/><br/>
<?php 
if ( isset($this->orders) && count($this->orders)>0 ) {
	
	echo "<hr>";
	echo "<div class=\"table-responsive\">
            <table class=\"table table-striped\">
              <thead>
                <tr>
                  
                  <th>餐品名称</th>
                  <th>订单号</th>
                  <th>订单状态</th>
                  <th>支付方式</th>
                  

                  <th>点位名称</th>

                  
                  <th>支付金额</th>
                  
                  <th>取餐码</th>
                  <th>取餐码日期</th>
                  <th>参与活动</th>
                  
                  
                  <th>退款？</th>
                  <th>退款金额</th>

                  <th>下单时间</th>
                </tr>
              </thead>
              <tbody>";
	
	foreach($this->orders as $order) {
		echo "<tr>";
		//echo "<td>".htmlspecialchars($order['order_id'])."</td>";
		//echo "<td>".htmlspecialchars($order['username'])."</td>";		
		//echo "<td>".htmlspecialchars($order['user_id'])."</td>";
		echo "<td>".htmlspecialchars($order['mdse_name'])."</td>";

		$order_status_desc = "";
		switch($order['order_status']) {
			case 2:
				$order_status_desc = "出货失败";
				break;
			case 3:
				$order_status_desc = "支付超时";
				break;
			case 4:
				$order_status_desc = "已付款";
				break;
			case 6:
				$order_status_desc = "订单完成";
				break;
			default:
				$order_status_desc = "未知";
				break;
		}
		
		$pay_type_desc = "";
		switch($order['pay_type']) {
			case 2:
				$pay_type_desc = "支付宝";
				break;
			case 3:
				$pay_type_desc = "微信";
				break;
			case 4:
				$pay_type_desc = "银联";
				break;
			case 10:
				$pay_type_desc = "活动免单";
				break;
			default:
				$pay_type_desc = "未知";
				break;
		}

		echo "<td>".htmlspecialchars($order['parent_id'])."</td>";
		//echo "<td>".htmlspecialchars($order['order_status'])."</td>";
		echo "<td>[".$order['order_status']."]".htmlspecialchars($order_status_desc)."</td>";
		echo "<td>".htmlspecialchars($pay_type_desc)."</td>";

		//echo "<td>".htmlspecialchars($order['inner_code'])."</td>";
		echo "<td>".htmlspecialchars($order['node_name'])."</td>";
		//echo "<td>".htmlspecialchars($order['node_address'])."</td>";
								
		
		echo "<td>".($order['pay_price']==0?'0':number_format($order['pay_price']/100, 2))."</td>";
		//echo "<td>".htmlspecialchars($order['coupon_name'])."</td>";

		echo "<td>".htmlspecialchars($order['food_code'])."</td>";
		echo "<td>".htmlspecialchars($order['food_date'])."</td>";
		echo "<td>".htmlspecialchars($order['channel'])."</td>";
		
		echo "<td>".htmlspecialchars($order['isRefund'])."</td>";
		echo "<td>".($order['refund_price']==0?'0':number_format($order['refund_price']/100, 2))."</td>";
		echo "<td>".date('m-d H:i', $order['created'] )."</td>";
		echo "</tr>";
	}
	
	echo "     </tbody>
            </table>
          </div>";
}
?>


<?php 
if ( isset($this->coupons) && count($this->coupons)>0 ) {
	
	echo "<hr>";
	echo "<div class=\"table-responsive\">
            <table class=\"table table-striped\">
              <thead>
                <tr>
                  <th>#</th>
                  <th>用户手机号</th>
                  <th>USERID</th>
                  <th>优惠券名称</th>
                  <th>金额(元)</th>
                  <th>生效时间</th>
                  <th>失效时间</th>
                  <th>仅限售货机</th>
                  <th>仅限商品</th>
                  <th>是否使用</th>
                  <th>来源渠道</th>
                  <th>创建时间</th>
                </tr>
              </thead>
              <tbody>";
	
	foreach($this->coupons as $coupon) {
		echo "<tr>";
		echo "<td>".htmlspecialchars($coupon['coupon_id'])."</td>";
		
		
		echo "<td>".htmlspecialchars($coupon['username'])."</td>";
		echo "<td>".htmlspecialchars($coupon['user_id'])."</td>";
		echo "<td>".htmlspecialchars($coupon['name'])."</td>";
		echo "<td>".number_format($coupon['money']/100, 2)."</td>";
		echo "<td>".date('Y-m-d H:i', $coupon['start_time'] )."</td>";
		echo "<td>".date('Y-m-d H:i', $coupon['end_time'] )."</td>";

		echo "<td>".htmlspecialchars($coupon['inner_code'])."</td>";
		echo "<td>".htmlspecialchars($coupon['mdse_ids'])."</td>";
		echo "<td>".htmlspecialchars($coupon['status_desc'])."</td>";
		echo "<td>".htmlspecialchars($coupon['reason'])."</td>";
		echo "<td>".date('Y-m-d H:i', $coupon['created'] )."</td>";
		echo "</tr>";
	}
	
	echo "     </tbody>
            </table>
          </div>";
}
?>

      <hr>

      <footer>
        <p>&copy; <?php echo TITLE;?></p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  </body>
</html>


