<div class="list__container">
  <div class="list__title">商品管理</div>
  <ul>
    <li class="list__subtitle">等待出貨：</li>
    <?php foreach ( $orders as $item ): ?>
      <?php if( $item['has_paid'] AND !$item['has_shipped'] ): ?> 
        <li class="list__item">
          <div>
            <div class="item__field"><?php echo $item['sn'] ?></div>
            <div class="item__field"><?php echo $item['buyer'] ?></div>
            <div class="item__field"><?php echo $item['total_price'] ?></div>
            <div class="item__field">已付款</div>
            <div class="item__field">未出貨</div>
          </div>
          <button class="item__btn" onclick="self.location.href='<?php echo base_url('admin/orders/show_detail/'.$item['id']) ?>'">
            詳情
          </button>
        </li>
      <?php endif?>
    <?php endforeach ?>
    <li class="list__subtitle">等待付款：</li>
    <?php foreach ( $orders as $item ): ?>
      <?php if( !$item['has_paid'] AND !$item['has_shipped'] ): ?> 
        <li class="list__item">
          <div>
            <div class="item__field"><?php echo $item['sn'] ?></div>
            <div class="item__field"><?php echo $item['buyer'] ?></div>
            <div class="item__field"><?php echo $item['total_price'] ?></div>
            <div class="item__field">未付款</div>
            <div class="item__field">未出貨</div>
          </div>
          <button class="item__btn" onclick="self.location.href='<?php echo base_url('admin/orders/show_detail/'.$item['id']) ?>'">
            詳情
          </button>
        </li>
      <?php endif?>
    <?php endforeach ?>
    <li class="list__subtitle">已結案：</li>
    <?php foreach ( $orders as $item ): ?>
      <?php if( $item['has_paid'] AND $item['has_shipped'] ): ?> 
        <li class="list__item">
          <div>
            <div class="item__field"><?php echo $item['sn'] ?></div>
            <div class="item__field"><?php echo $item['buyer'] ?></div>
            <div class="item__field"><?php echo $item['total_price'] ?></div>
            <div class="item__field">已付款</div>
            <div class="item__field">已出貨</div>
          </div>
          <button class="item__btn" onclick="self.location.href='<?php echo base_url('admin/orders/show_detail/'.$item['id']) ?>'">
            詳情
          </button>
        </li>
      <?php endif?>
    <?php endforeach ?>
  </ul>
</div>