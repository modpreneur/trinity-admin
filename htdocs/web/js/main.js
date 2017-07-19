$('.item-menu input:checkbox').click(function() {
    $('.item-menu input:checkbox').not(this).prop('checked', false);
});