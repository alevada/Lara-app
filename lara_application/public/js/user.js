$(function() {
	$('a.actionDeleteUser').on('click', function(event) {
        if (!confirm('Are you sure you want to delete this user?'))
            event.preventDefault();
    });

    $('.alert').delay(3000).fadeOut(300);
});