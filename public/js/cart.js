$(function(){
  // 商品刪除按鍵處理
  $('.item__delete-btn').click( e => {
    $.post( 'cart/delete_item', { key: $(e.target).data('key') } )
    .done(location.reload() ) //商品刪除後，頁面重置，已重新計算商品總值
  })

  // 使用者輸入資料檢查
  $('#checkout-btn').click( () =>{
    let buyer = $('input[name="buyer"]').val()
    let tel = $('input[name="tel"]').val()
    let email = $('input[name="email"]').val()
    let address = $('input[name="address"]').val()
    let pay_method = $('input[name="pay_method"]').val()

    if( buyer && tel && address ) {
      // 按下結帳按鍵後，將使用者輸入的資料上傳
      $.post( BASE_URL + '/cart/pre_checkout', {buyer, tel, email, address, pay_method} )
      .done( res => {
        if( res === 'ok') {
          location.href = 'checkout'
        }
      })

    } else swal("請填入收件人資料", "各項皆為必填唷", "warning");
  })

  $('.item__quantity').change( e => {
    let key = $(e.target).data('key')
    let quantity = $(e.target).val()
    $.post( BASE_URL + '/cart/quantity_modify', { key , quantity } )
      .done( res => {
        if( res === 'ok' ) location.reload();
      })
  })

})