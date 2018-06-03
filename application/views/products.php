
<div class="title">莊園精選咖啡豆</div>
<div class="item__wrapper">
  <?php foreach( $products as $item ): ?>
    <div class="products__item">
      <div class="item__img-ctl">
        <?php echo img([ 'src'     => $item['img'],
                          'class'   => 'item__img',
                          'data-id' => $item['id'] ]) ?>
      </div>
      <div class="item__name" data-id=<?php echo $item['id'] ?>><?php echo $item['name'] ?></div>
      <div class="item__price">NT$ <?php echo $item['price'] ?></div>
      <button class="item__add-to-cart" data-id=<?php echo $item['id'] ?>>加入購物車</button>
    </div>
  <?php endforeach ?>
</div>


<div class="modal__background">

  <div class="modal__container">
  <span class="modal__close">&times;</span>
  
  <div class="detail__img-ctl"><img /></div>

    <div class="detail__container">

      <div class="detail__name"></div>

      <div class="detail__price"></div>

      <button class="item__add-to-cart">加入購物車</button>

      <div class="detail__intro"></div>
    </div>

  </div>
</div>
