$(function(){
  $('.login__btn').click( e => {
    e.preventDefault()

    let username = $('input[name="username"]').val()
    let password = $('input[name="password"]').val()

    if( username && password) {

      $.post(BASE_URL + 'admin/login', { username: username, password: password })
      .done( res => {
        if(res === 'ok'){
          location.href = BASE_URL + 'admin/products'
          
        }else if(res === 'error'){
          $('.login__warning').text('帳號/密碼錯誤')
        }
      })

    } else {

      $('.login__warning').text('請輸入帳號及密碼')
      
    }
  })
})