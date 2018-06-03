<div class="detail__container">
  <div class="detail__title">修改商品介紹</div>

  <a class="back-link" href=<?php echo base_url('admin/products/show_list') ?>> << 回到商品列表 </a> 

  <?php echo form_open_multipart( base_url('admin/products/handle_modify') ) ?>

    <div class="img-wrapper detail__item">
      <div class="detail__img-ctl"><?php echo img( array('src'=>$product['img'] ) ); ?></div>
      <div>
        <input class="detail__select-btn" type="file" name="userfile" />
      </div>
    </div>
 
    <input class="invisible" name="product_id" type="text" value="<?php echo $product['id'] ?>" readonly />
    
    <label for="name">名稱：</label>
    <input class="detail__item" name="name" type="text" value="<?php echo $product['name'] ?>" />
    <label for="price">售價：</label>
    <input class="detail__item" name="price" type="number" value="<?php echo $product['price'] ?>" />
    
    
    <label for="intro">商品介紹</label>
    <textarea class="detail__item" name="intro" type="text"><?php echo $product['intro'] ?></textarea>
    <label for="selling">上架狀態：</label>
    <select class="detail__item" name="selling">
      <?php if($product['selling'] == TRUE): ?>
    　  <option value="1" selected>銷售中</option>
    　  <option value="0">下架</option>
      <?php else: ?>
        <option value="1">銷售中</option>
    　  <option value="0" selected>下架</option>
      <?php endif ?>
    </select>
    <div id="detail__message"></div>
    <input class="detail__submit" type="submit" value="確定" />
  </form>
</div>