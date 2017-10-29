(function($) {
    $(function() {
        initDeleteConfirmation();
    });
}(jQuery));

function initDeleteConfirmation()
{
    $('*[data-delete]').click(function (e) {
        var message = $(this).attr('data-delete');

        if (message.length === 0) {
            message = 'Are you sure you want to delete this item?';
        }

        return confirm(message);
    });
}
