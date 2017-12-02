(function ($) {
    $(function () {
        initDeleteConfirmation()
        initConsumerStatusFields()
    });
}(jQuery))

function initDeleteConfirmation() {
    $('*[data-delete]').click(function (e) {
        let message = $(this).attr('data-delete')

        if (message.length === 0) {
            message = 'Are you sure you want to delete this item?'
        }

        return confirm(message)
    })
}

function initConsumerStatusFields() {
    const form = $('#consumer-status')
    const statusField = form.find('#status_id')
    if (!statusField.length) {
        return
    } else {
        updateConsumerStatusFields(form, statusField)
        statusField.on('change', (e) => {
            updateConsumerStatusFields(form, $(e.target))
        })
    }
}

function updateConsumerStatusFields(form, statusField) {
    const membershipFields = form.find('#status-member')
    const dependantFields = form.find('#status-dependant')
    const val = parseInt(statusField.val())
    switch (val) {
        case 2:
            membershipFields.show()
            dependantFields.hide()
            break
        case 3:
            membershipFields.hide()
            dependantFields.show()
            break
        default:
            membershipFields.hide()
            dependantFields.hide()
            break
    }
}
