<div class="detail__container">
  <div class="detail__title">修改商品介紹</div>
  <a class="back-link" href=<?php echo base_url('admin/orders/show_list') ?>>
    << 回到訂單列表
  </a>
  <?php echo form_open( base_url('admin/orders/handle_modify') ) ?>
    <div class="detail__wrapper">  
      <div class="item-wrapper">訂單編號：<div class="detail__item"><?php echo $order['sn'] ?></div></div>
      <div class="item-wrapper">金額：<div class="detail__item"><?php echo $order['total_price'] ?></div></div>
      <div class="item-wrapper">訂購人：<div class="detail__item"><?php echo $order['buyer'] ?></div></div>
      <div class="item-wrapper">連絡電話：<div class="detail__item"><?php echo $order['tel'] ?></div></div>
      <div class="item-wrapper">地址：<div class="detail__item"><?php echo $order['address'] ?></div></div>
      <div class="item-wrapper">付款方式：<div class="detail__item"><?php echo $order['pay_method'] ?></div></div>
    </div>

    <div>
      <ul class="detail__list">
        <li class="list__subtitle">訂單內容：</li>
        <?php foreach ( $order_contents as $item ): ?>
          <li class="list__item">
            
              <div class="item__field"><?php echo $item['name'] ?></div>
              <div class="item__field"><?php echo $item['price'] ?></div>
              <div class="item__field"><?php echo $item['quantity'] ?></div>
            
          </li>
        <?php endforeach; ?>
        <li  class="list__item">
          <div class="item__field">運費：</div>
          <div class="item__field"><?php echo $order['shipping_fee'] ?></div>
          <div class="item__field"></div>
        </li>
      </ul>
    </div>

    <div class="detail__wrapper">  
      <div class="item-wrapper">
        付款狀態：
        <div class="detail__item <?php if( !$order['has_paid'] ) echo 'warning' ?>">
          <?php echo $order['has_paid'] ? '已付款' : '未付款' ?>
        </div>
      </div>
      
      <div class="item-wrapper">出貨狀態：
        <div>
          <select class="detail__item" name="has_shipped" <?php if( !$order['has_paid'] ) echo 'disabled' ?>>
            <?php if( $order['has_shipped'] ): ?>
          　  <option value="1" selected>已出貨</option>
          　  <option value="0">未出貨</option>
            <?php else: ?>
              <option value="1">已出貨</option>
          　  <option value="0" selected>未出貨</option>
            <?php endif ?>
          </select>
        </div>
      </div>
    </div>
    <input class="invisible" name="order_id" type="text" value="<?php echo $order['id'] ?>" readonly />
    <input class="detail__submit" type="submit" value="確定" <?php if( !$order['has_paid'] ) echo 'disabled' ?> />
  </form>
</div>