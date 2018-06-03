<div class="list__container">
  <div class="list__title">留言列表</div>
  <ul>
    <li class="list__subtitle">未回覆：</li>
    <?php foreach ( $messages as $item ): ?>
      <?php if( !$item['has_replied'] ): ?> 
        <li class="list__item">
          <div>
            <div class="item__field"><?php echo $item['created_by'] ?></div>
            <div class="item__field"><?php echo $item['name'] ?></div>
            <div class="item__field"><?php echo $item['message'] ?></div>
          </div>
          <button class="item__btn" data-id=<?php echo $item['id'] ?>>
            詳情
          </button>
        </li>
      <?php endif?>
    <?php endforeach ?>
    <li class="list__subtitle">已結案：</li>
    <?php foreach ( $messages as $item ): ?>
      <?php if( $item['has_replied'] ): ?> 
        <li class="list__item">
          <div>
            <div class="item__field"><?php echo $item['created_by'] ?></div>
            <div class="item__field"><?php echo $item['name'] ?></div>
            <div class="item__field"><?php echo $item['message'] ?></div>
          </div>
          <button class="item__btn" data-id=<?php echo $item['id'] ?>>
            詳情
          </button>
        </li>
      <?php endif?>
    <?php endforeach ?>
  </ul>
</div>

<div class="modal">
  <div class="modal__container">
  <span class="modal__close">&times;</span> 
    <div class="modal__wrapper">
      <label for="name">姓名：</label>
      <div class="detail__item" id="name"></div>
      <label for="created_by">留言時間：</label>
      <div class="detail__item" id="created_by"></div>
      <label for="tel">連絡電話：</label>
      <div class="detail__item" id="tel"></div>
      <label for="email">E-mail：</label>
      <div class="detail__item" id="email"></div>
      <label for="email">處理狀態</label>
      <select class="detail__item" name="has_replied" id="has_replied">
        <option value='1'>已回覆</option>
        <option value='0'>未回覆</option>
      </select>
      <label for="message">留言內容：</label>
      <div class="detail__item" id="message"></div>
    </div>
  </div>
</div>