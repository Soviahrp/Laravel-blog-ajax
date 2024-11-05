let submit_method;

$(document).ready(function () {
    writerTable();
});

// datatable serverside
function writerTable() {
    $('#yajra').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "/admin/writers/serverside",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'is_verified',
                name: 'is_verified'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
}

// form edit
const editData = (e) => {
    let id = $(e).data('id');
    submit_method = 'edit';

    startLoading();
    resetForm('#formWriter');
    resetValidation();

    $.ajax({
        type: "GET",
        url: "/admin/writers/" + id,
        success: function (response) {
            let data = response.data;

            $('#id').val(data.id);
            $('#verification_status').val(data.is_verified ? 'verified' : 'unverified');

            $('#modalWriter').modal('show');
            $('.modal-title').html('<i class="fa fa-edit"></i> Edit Writer');
            $('.btnSubmit').html('<i class="fa fa-save"></i> Save');

            stopLoading();
        },
        error: function (xhr) {
            stopLoading();
            toastError('Error loading writer data');
        }
    });
}

const deleteData = (e) => {
    let id = $(e).data('id');

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this writer?",
        icon: "question",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        allowOutsideClick: false,
        showCancelButton: true,
        showCloseButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            startLoading();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "/admin/writers/" + id,
                success: function (response) {
                    stopLoading();
                    $('#yajra').DataTable().ajax.reload();
                    toastSuccess(response.message);
                },
                error: function (xhr) {
                    stopLoading();
                    toastError(xhr.responseText);
                }
            });
        }
    });
}

// save data
$('#formWriter').on('submit', function (e) {
    e.preventDefault();
    startLoading();

    const id = $('#id').val();
    const url = `/admin/writers/${id}`;

    const formData = new FormData(this);
    formData.append('_method', 'PUT');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            stopLoading();
            $('#modalWriter').modal('hide');
            $('#yajra').DataTable().ajax.reload();
            resetForm('#formWriter');
            resetValidation();
            toastSuccess(response.message);
        },
        error: function (xhr) {
            stopLoading();
            if (xhr.status === 422) {
                toastError('Validation error: Please check your input');
            } else {
                toastError('Error updating writer');
            }
        }
    });
});
