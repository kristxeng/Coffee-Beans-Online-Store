$(function () {
  //新增商品的 modal 顯示 toggle
  $('#create-btn').click( () => {
    $('.modal').show("slow")
  })

  //新增商品右上的 close 按鍵處理
  $('.modal__close').click( () => {
    $('.modal').hide()
  })

  //點擊 modal 暗背景也可關閉 modal
  $(document).click( e => {
    if ($(e.target).hasClass('modal') ) {
      $('.modal').hide()
    }
  })

  $('.detail__submit').click( e => {
    // 使用預設圖片新增商品的處理
    if ($('input:file').val() == '') {
      e.preventDefault();
      // $('.modal__message').text('請選擇要上傳的圖片檔案！')
      let name = $('input[name="name"]').val()
      let price = $('input[name="price"]').val()
      let intro = $('textarea[name="intro"]').val()

      if( name && price && intro ) {

        $.post(BASE_URL + 'admin/products/create_with_default_img', { name, price, intro })
        .done(res => {
          if (res === 'ok') {
            location.href = BASE_URL + "admin/products/"
          }
        })

      } else $('.modal__message').text('各項皆為必填，請輸入資料！')
    }
  })

})