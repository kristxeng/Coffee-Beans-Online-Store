$(function () {
  // 點選商品圖片或商品名稱時，應跳出 Product Detail Modal 的處理
  $('.item__wrapper').on('click', e => {
    if (e.target.className === 'item__img' || e.target.className === 'item__name') {
      //取得自訂參數中的 product_id
      let product_id = $(e.target).data('id')
      //利用 product_id 取得完整商品資料
      $.post(BASE_URL + 'products/get_detail', { product_id: product_id })
      .done( res => {

        let product = JSON.parse(res)

        $('.detail__img-ctl>img').attr('src', product.img);
        $('.detail__name').text(product.name)
        $('.detail__price').text('NT$' + product.price)
        $('.detail__intro').text(product.intro)
        $('.detail__container>.item__add-to-cart').data('id', product.id)
        // console.log($( '.detail__container>.item__add-to-cart').data('id') )

        $('.modal__background').show('slow')
      })
    }
  })

  // Modal 右上方關閉按鍵處理
  $('.modal__close').click( () => {
    $('.modal__background').hide()
  })

  // 點擊 Modal 背景時，應該關閉 Modal 的處理
  $(document).click( e => {
    if ( e.target.className === 'modal__background') {
      $('.modal__background').hide()
    }
  })

  // 加入購物車按鍵處理
  $('.item__add-to-cart').click( e => {
    $.post(BASE_URL + 'cart/add_to_cart', { product_id: $(e.target).data('id') })
    .done( () => {
      swal("已加入購物車！","" , "success");

      // 更新 float cart icon 的值
      (function() {
        $.post(BASE_URL + '/cart/get_quantity')
          .done(res => $('#float-cart>span').text(res))
      }());
    })
  })
})