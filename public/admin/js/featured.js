$(function () {
  $('.detail__submit').click( e => {
    e.preventDefault()
    let left = $('select[name="left"]').val()
    let middle = $('select[name="middle"]').val()
    let right = $('select[name="right"]').val()

    $.post( BASE_URL + 'admin/featured/handle_modify', { left, middle, right })
    .done( res => {

      if (res === 'ok') {
        
        $('.featrued__message').text('修改成功')
      }
    })
  })
})
