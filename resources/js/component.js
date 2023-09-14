// DELETE
$('.btn-delete-blog').click(function() {
    var index = $('.btn-delete-blog').index(this)
    $('.box-delete-blog').eq(index).show()
})

$('.btn-delete-user').click(function() {
    var index = $('.btn-delete-user').index(this)
    $('.box-delete-user').eq(index).show()
})

$('.btn-delete-category').click(function() {
    var index = $('.btn-delete-category').index(this)
    $('.box-delete-category').eq(index).show()
})

$('.cancel-box-delete').click(function () {
    var index = $('.cancel-box-delete').index(this)
    $('.box-delete').eq(index).hide()
})

$('.cancel-global').click(function () {
    var index = $('.cancel-global').index(this)
    $('.box-delete').eq(index).hide()
})

// UPDATE
$('.btn-update-category').click(function() {
    var index = $('.btn-update-category').index(this)
    $('.box-update').eq(index).show()
})
$('.cancel-global-update').click(function () {
    var index = $('.cancel-global-update').index(this)
    $('.box-update').eq(index).hide()
})
