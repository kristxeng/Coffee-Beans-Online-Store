<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <img src="./public/img/slide1_1920x750.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <img src="./public/img/slide2_1920x750.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <img src="./public/img/slide3_1920x750.jpg" style="width:100%">
  </div>

</div>

<div class="topic">
  <div class="topic__img-ctl">
    <img src=<?php echo base_url('public/img/topic01_1000x600.jpg')?> />
  </div>
  <div class="topic__content">
    <div class="topic__title">手工挑豆 &loz; 產地精選</div>
    <p>咖啡生豆常混入雜質及不良豆，雜質就是指一些砂石、枯枝類的雜物，而不良豆我們多稱之為「瑕疵豆」。在烘焙之前，若沒有細心地以人工方式將這些雜質及瑕疵豆挑除的話，將會影響到整體的咖啡品質及風味。</p>
  </div>
</div>

<div class="topic topic--reverse">
  <div class="topic__img-ctl">
    <img src=<?php echo base_url('public/img/topic02_1000x600.jpg')?> />
  </div>
  <div class="topic__content">
    <div class="topic__title">嚴選品質 &loz; 新鮮現磨</div>
    <p>咖啡豆在烘焙之後，會開始進行一連串的化學變化，釋放風味，同時也排出大量的二氧化碳。二氧化碳可以幫助咖啡豆抵擋氧氣與濕氣，避免快速腐敗，進而保持咖啡豆最完整的風味。</p>
  </div>
</div>

<div class="featured-set">
  <?php foreach( $featured as $item ): ?>
    <div class="featured__item">
      <div class="item__img-ctl">
        <?php echo img([ 'src'     => $item['img'],
                         'class'   => 'item__img',
                         'data-id' => $item['product_id'] ]) ?>
      </div>
      <div class="item__name" data-id=<?php echo $item['product_id'] ?>>
        <?php echo $item['name'] ?>
      </div>
      <div class="item__price">NT$ <?php echo $item['price'] ?></div>
      <button class="item__add-to-cart" data-id=<?php echo $item['product_id'] ?>>加入購物車</button>
    </div>
  <?php endforeach ?>
</div>
