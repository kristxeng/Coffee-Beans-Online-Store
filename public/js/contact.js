$(function() {
  $('input[type="submit"]').click( e => {
    e.preventDefault();
    let name = $('input[name="name"]').val()
    let tel = $('input[name="tel"]').val()
    let email = $('input[name="email"]').val()
    let message = $('textarea').val()

    // 姓名及訊息必填，電話、E-mail 擇一
    if( name && message && (tel||email) ) {
      $.post(BASE_URL + 'contact', {name, tel, email, message})
      .done( res => {
        if( res === 'ok') {
          // 將輸入欄位清空後，顯示成功訊息
          $('input[name="name"]').val('')
          $('input[name="tel"]').val('')
          $('input[name="email"]').val('')
          $('textarea').val('')
          swal("我們已收到您的訊息囉！", "", "success")
        }
      })
    } else if( !( name&&message ) ) {
      swal("請輸入姓名及訊息", "您的姓名及要給我們的訊息為必填唷", "warning");
    } else {
      swal("請輸入電話或 E-mail", "電話 / E-mail 至少要填寫一項，才能收到我們的回覆唷", "warning");
    }
  })
})