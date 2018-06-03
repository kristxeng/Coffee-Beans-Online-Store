$(function () {
  // handle responsive menu collapse toggle
  $('.nav__container').on('click','.menu__toggle', e => {
    e.preventDefault()
    $('.nav__menu').toggle('slow')
  });

  // 更新 float cart icon 的值
  (function() {
    $.post(BASE_URL + '/cart/get_quantity')
      .done( res => { 
         $('#float-cart>span').text(res) 
      })
  }());

  $('#float-cart').click( () => {
    location.href=BASE_URL+'cart'
  });
})