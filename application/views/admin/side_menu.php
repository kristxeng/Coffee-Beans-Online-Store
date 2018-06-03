<div class="menu__container">
    <div class="menu__title">管理者頁面</div>
    <div class="menu__header">
      <div class="menu__username"><?php echo $admin_user ?></div>
      <button class="logout-btn" onclick="javascript:location.href='<?php echo base_url('admin/admin/logout') ?>'">Logout</button>
    </div>
  <ul class="menu__list">
    <li class="menu__item">
      <a href=<?php echo base_url('admin/products')?>>
        商品管理
      </a>
    </li>
    <li class="menu__item">
      <a href=<?php echo base_url('admin/orders')?>>
        訂單管理
      </a>
    </li>
    <li class="menu__item">
      <a href=<?php echo base_url('admin/featured')?>>
        設定精選商品
      </a>
    </li>
    <li class="menu__item">
      <a href=<?php echo base_url('admin/messages')?>>
        留言管理
      </a>
    </li>
  </ul>
</div>