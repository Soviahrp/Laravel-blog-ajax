
function toggleConfirmation(button) {
    const uuid = $(button).data('id');
    const currentStatus = $(button).data('status');

    // Set values to modal
    $('#article_uuid').val(uuid);
    $('#confirmation_status').val(currentStatus);

    // Show modal
    $('#confirmationModal').modal('show');
}


function submitConfirmation() {
    const uuid = $('#article_uuid').val();
    const status = $('#confirmation_status').val();

    if (!status) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Please select confirmation status!'
        });
        return;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/admin/articles/${uuid}/toggle-confirmation`,
        type: 'POST',
        data: {
            status: status
        },
        beforeSend: function () {
            startLoading();
        },
        success: function (response) {
            stopLoading();
            $('#confirmationModal').modal('hide');

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message
            });

            // Reload DataTable
            $('#yajra').DataTable().ajax.reload(null, false);
        },
        error: function (xhr) {
            stopLoading();
            $('#confirmationModal').modal('hide');

            const message = xhr.responseJSON?.message || 'Something went wrong!';
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message
            });
        }
    });
}


$('#confirmationModal').on('hidden.bs.modal', function () {
    $('#confirmationForm')[0].reset();
});

