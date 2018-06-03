$(function(){

  // 首頁版頭 carousel 處理
  var slideIndex = 0;
  showSlides();

  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
  }

  // 加入購物車按鍵處理
  $('.item__add-to-cart').click( e => {

    $.post(BASE_URL + 'cart/add_to_cart', { product_id: $(e.target).data('id') })
    .done( () => {
      swal("已加入購物車！", "", "success");
      
      // 更新 float cart icon 的值
      (function() {
        $.post(BASE_URL + '/cart/get_quantity')
          .done(res => $('#float-cart>span').text(res))
      }());
    })
  })
})