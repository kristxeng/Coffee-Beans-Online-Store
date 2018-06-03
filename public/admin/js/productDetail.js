$(function () {
  $('.detail__submit').click( e => {
    // 如果沒有選擇圖片檔案，僅文字修改的處理
    if ($('input:file').val() == '' ) {
      e.preventDefault();
      let product_id = $('input[name="product_id"]').val()
      let name = $('input[name="name"]').val()
      let price = $('input[name="price"]').val()
      let intro = $('textarea[name="intro"]').val()
      let selling = $('select[name="selling"]').val()

      if( product_id && name && price && intro ) {

        $.post( BASE_URL + 'admin/products/handle_modify_without_img', { product_id, name, price, selling, intro })
        .done( res => {
          if( res === 'ok' ) {
            $('#detail__message').text('修改成功')
          }
        })
        
      } else $('#detail__message').text('各項皆為必填唷！')
    }
  })

})