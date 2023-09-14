// USER PAGE
$('#selectRole').change(function() {
    location.href = $(this).val();
})

$('#selectStatus').change(function() {
    location.href = $(this).val()
})

// BLOG PAGE
$('#selectStatusBlog').change(function() {
    location.href = $(this).val()
})
$('#selectCategory').change(function() {
    location.href = $(this).val()
})

// CATEGORY
$('#btnNewCategory').click(function() {
    $('#boxNewCategory').show()
})

$('.cancel-box-add').click(function() {
    $('.box-add').hide()
})
