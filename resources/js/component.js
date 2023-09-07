$('.btn-delete-blog').click(function() {
    var index = $('.btn-delete-blog').index(this)
    $('.box-delete-blog').eq(index).show()
})

$('.btn-delete-user').click(function() {
    var index = $('.btn-delete-user').index(this)
    console.log(index);
    $('.box-delete-user').eq(index).show()
})

$('.cancel-box-delete').click(function () {
    var index = $('.cancel-box-delete').index(this)
    $('.box-delete-blog').eq(index).hide()
    $('.box-delete-user').eq(index).hide()
})

$('.cancel-global').click(function () {
    var index = $('.cancel-global').index(this)
    $('.box-delete').eq(index).hide()
})
