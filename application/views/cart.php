<div class="container">
  <div class="title">購物車</div>
  <div class="item-wrapper">
    <?php if( $this->session->userdata('cart') ): ?>
      <ul>
        <li>
          <div>品名</div>
          <div>價格</div>
          <div>數量</div>
          <div>小計</div>
          <div class="item__delete-btn"></div>
        </li>
        <?php foreach( $_SESSION['cart'] as $key => $item ): ?>
          <li>
            <div><?php echo $item['name'] ?></div>
            <div><?php echo $item['price'] ?></div>
            <div>
              <select class="item__quantity" data-key=<?php echo $key ?>>
                <?php for($i=1; $i<11; $i++): ?>
                  <option value=<?php echo $i ?> <?php if($i == $item['quantity']) echo 'selected' ?>>
                    <?php echo $i ?>
                  </option>
                <?php endfor ?>
              </select>
            </div>
            <div><?php echo $item['price']*$item['quantity'] ?></div>
            <div class="item__delete-btn" data-key=<?php echo $key ?>>&times;</div>
          </li>
        <?php endforeach ?>
        <li>
          <div></div>
          <div></div>
          <div>小計：</div>
          <div><?php echo $_SESSION['total_price'] ?></div>
          <div class="item__delete-btn"></div>
        </li>
      </ul>

      <div class="user-info__wrapper">
        <h2 class="user-info__title">請填寫收件人資料</h2>
        <div>
          <label for="buyer">姓名：</label>
          <input name="buyer" type="text" />
        </div>
        <div>
          <label for="tel">電話：</label>
          <input name="tel" type="text" />
        </div>
        <div>
          <label for="email">E-mail：</label>
          <input name="email" type="text" />
        </div>
        <div>
          <label for="address">地址：</label>
          <input name="address" type="text" />
        </div>
        <div>
          <label for="pay_method">付款方式：</label>
          <select name="pay_method">
            <option value="Credit" selected>信用卡</option>
            <!-- <option value="CVS" disabled>超商繳費</option>
            <option value="ATM" disabled>匯款</option> -->
          </select>
        </div>
      </div>
      <div class="cart__btn-group">
        <button onclick="javascript:location.href='<?php echo base_url('products') ?>'">繼續選購</button>
        <button id="checkout-btn">結帳 &Gg;</button>
      </div>
    <?php else: ?>
      <div class="cart__message">
        目前購物車內無任何商品！
      </div>
    <?php endif ?>
  </div>
</div>