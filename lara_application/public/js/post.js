$(function() {
	$('a.actionDeletePost').on('click', function(event) {
        if (!confirm('Are you sure you want to delete this post?'))
            event.preventDefault();
    });

    $('.alert').delay(3000).fadeOut(300);
});