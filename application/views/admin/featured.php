<div class="list__container">
  <div class="list__title">首頁精選商品管理</div>
  <?php echo form_open( base_url('admin/featured/handle_modify') ) ?>
    <ul>
      <li class="list__subtitle">左：</li>
      <li>
        <select class="detail__item" name="left">
          <?php foreach( $products as $item ): ?>
              <option value="<?php echo $item['id'] ?>" <?php if($item['id']==$featured[0]['product_id']) echo 'selected' ?>>
                <?php echo $item['name'] ?>
              </option>
          <?php endforeach ?>
        </select>
      </li>

      <li class="list__subtitle">中：</li>
      <li>
        <select class="detail__item" name="middle">
          <?php foreach( $products as $item ): ?>
              <option value="<?php echo $item['id'] ?>" <?php if($item['id']==$featured[1]['product_id']) echo 'selected' ?>>
                <?php echo $item['name'] ?>
              </option>
          <?php endforeach ?>
        </select>
      </li>

      <li class="list__subtitle">右：</li>
      <li>
        <select class="detail__item" name="right">
          <?php foreach( $products as $item ): ?>
              <option value="<?php echo $item['id'] ?>" <?php if($item['id']==$featured[2]['product_id']) echo 'selected' ?>>
                <?php echo $item['name'] ?>
              </option>
          <?php endforeach ?>
        </select>
      </li>
    </ul>
    <div class="featrued__message"></div>
    <input class="detail__submit" type="submit" value="確定" />
  </form>
</div>