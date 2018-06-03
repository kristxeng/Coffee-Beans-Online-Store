<div class="list__container">
  <div class="list__title">商品管理</div>
  <div class="product__create">
    <button id="create-btn">新增商品</button>
  </div>
  <ul>
    <?php foreach ( $products as $item ): ?>
      <li class="list__item">
        <div>
          <div class="list__img-ctl">
            <?php echo img( ['src'=>$item['img']] ); ?>
          </div>
          <div class="item__field"><?php echo $item['name'] ?></div>
          <div class="item__field"><?php echo $item['price'] ?></div>
          <div class="item__field">
            <?php if($item['selling'] == TRUE): ?> 
              銷售中
            <?php else: ?>
              下架
            <?php endif ?>
          </div>
        </div>
        <button class="item__btn" onclick="self.location.href='<?php echo base_url('admin/products/show_detail/'.$item['id']) ?>'">
          修改
        </button>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="modal">

  <div class="modal__container">
    <span class="modal__close">&times;</span>
    
    <div class="modal__wrapper">
      <div class="detail__title">新增商品</div>

      <div class="modal__message"></div>

      <?php echo form_open_multipart('admin/products/handle_create');?>
        <div class="">
          
          <label for="img">圖片：(檔案規格上限：600x600px / 1MB，若未選擇檔案，將使用預設圖片)</label>
          <input class="detail__select-btn" type="file" name="userfile" />
          
          <label for="name">名稱：</label>
          <input class="detail__item" name="name" type="text" value="" />

          <label for="price">售價：</label>
          <input class="detail__item" name="price" type="number" value="" />

          <label for="intro">商品介紹</label>
          <textarea class="detail__item" name="intro" type="text"></textarea>
        </div>
        <input class="detail__submit" type="submit" value="確定" />
      </form>

  </div>

</div>

