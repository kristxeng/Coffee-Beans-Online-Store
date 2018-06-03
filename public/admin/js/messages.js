$(function () {
  //新增商品的 modal 顯示 toggle
  $('.item__btn').click( e => {
    let message_id = $(e.target).data('id')
    $.post(BASE_URL + 'admin/messages/get_detail', { message_id })
    .done( res => {

      let message = JSON.parse(res)
      $('#name').text(message.name)
      $('#created_by').text(message.created_by)
      $('#tel').text(message.tel)
      $('#email').text(message.email)
      $('#has_replied').val(message.has_replied)
      $('#has_replied').data('id', message_id) //修改回覆狀態時會用到
      $('#message').text(message.message)
      $('.modal').show("slow")

    })
  })

  //新增商品右上的 close 按鍵處理
  $('.modal__close').click(() => {
    $('.modal').hide()
  })

  //點擊 modal 暗背景也可關閉 modal
  $(document).click(e => {
    if ($(e.target).hasClass('modal')) {
      $('.modal').hide()
    }
  })

  $('#has_replied').change( () => {
    $.post( BASE_URL + 'admin/messages/modify_replied',{
      'message_id': $('#has_replied').data('id'),
      'has_replied': $('#has_replied').val() 
    })
    .done( res => {
      if(res==='ok') {
        location.href = BASE_URL + 'admin/messages'
      }
    })
  })
})