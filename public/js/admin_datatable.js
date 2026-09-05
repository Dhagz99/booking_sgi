$(document).ready(function() {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




    $(".default_datatable_RoomRateList").on("click", "tbody .btn_table_edit_roomRate", function () {
        var data_table_modal_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: '/EditRoomRate_Modal',
            data: { data_table_modal_id: data_table_modal_id },
            dataType: 'json',
            success: function (data) {
                console.log("AJAX Response:", data); // Log the response
                if (data.success) {
                    $(".edit_room_type_id").val(data.room_type_id);
                    $(".edit_room_type").val(data.room_type);
 
                    $("#EditRoomRate-modal").removeClass('hidden').addClass('flex');
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Data',
                        text: 'No records found!'
                    });
                }
            },
            error: function (xhr, errmsg, err) {
                console.error("Error response:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });

    });
    





    $(".default_datatable_RoomRateList").on("click", "tbody .btn_table_delete_roomRate", function () {
        var folio_number = $(this).attr('data-id');
        var roomRAtes = $(this).attr('data-room-rate');


        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete this room type - ${roomRAtes}. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '/deleteRoomType',
                    data: {
                        folio_number: folio_number,
                        _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted Successfully',
                                confirmButtonColor: '#08655D',
                                showConfirmButton: true,
                                confirmButtonText: "Ok"
                            }).then(function() {
                                window.location.reload(); // Reload the page after successful deletion
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.error_message || 'Something went wrong!'
                            });
                        }
                    },
                    error: function(xhr, errmsg, err) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while trying to delete the item.'
                        });
                    }
                });
            }
        });
    });
    












// EDIT COMPANY

$(".default_datatable_CompanyList").on("click", "tbody .btn_table_edit_company", function () {
    var data_table_modal_id = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/EditCompany_Modal',
        data: { data_table_modal_id: data_table_modal_id },
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $(".edit_company_id").val(data.company_id);
                $(".edit_company").val(data.company);

                $("#EditCompany-modal").removeClass('hidden').addClass('flex');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Data',
                    text: 'No records found!'
                });
            }
        },
        error: function (xhr, errmsg, err) {
            console.error("Error response:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        }
    });

});



// DELETE COMPANY


$(".default_datatable_CompanyList").on("click", "tbody .btn_table_delete_company", function () {
    var id = $(this).attr('data-id');
    var company_name = $(this).attr('data-company');


    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this room type - ${company_name}. This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/deleteCompany',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted Successfully',
                            confirmButtonColor: '#08655D',
                            showConfirmButton: true,
                            confirmButtonText: "Ok"
                        }).then(function() {
                            window.location.reload(); // Reload the page after successful deletion
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.error_message || 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr, errmsg, err) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while trying to delete the item.'
                    });
                }
            });
        }
    });
});

















// DELETE CUSTOMER
$(".default_datatable_customerList").on("click", "tbody .btn_table_delete_customer", function () {
    var id = $(this).attr('data-id');

    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this custome. This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/deleteCustomer',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted Successfully',
                            confirmButtonColor: '#08655D',
                            showConfirmButton: true,
                            confirmButtonText: "Ok"
                        }).then(function() {
                            window.location.reload(); // Reload the page after successful deletion
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.error_message || 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr, errmsg, err) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while trying to delete the item.'
                    });
                }
            });
        }
    });
});

// EDIT CUSTOMER
$(".default_datatable_customerList").on("click", "tbody .btn_table_edit_customer", function () {
    var data_table_modal_id = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/EditCustomer_Modal',
        data: { data_table_modal_id: data_table_modal_id },
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $(".edit_customer_id").val(data.customer_id);
                $(".edit_customer_first_name").val(data.first_name);
                $(".edit_customer_last_name").val(data.last_name);
                $("#EditCustomer-modal").removeClass('hidden').addClass('flex');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Data',
                    text: 'No records found!'
                });
            }
        },
        error: function (xhr, errmsg, err) {
            console.error("Error response:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        }
    });

});


















// EDIT CHARGESSS

$("#chargesTable1").on("click", "tbody .btn_table_edit_charges_admin", function () {
    var data_table_modal_id = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/EditChargeAdmin',
        data: { data_table_modal_id: data_table_modal_id },
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $(".edit_charges_id").val(data.id);
                $(".edit_charges_description").val(data.charge_description);
                $(".edit_charges_price").val(data.price);
                $(".edit_charge_rate_type").val(data.rate_type);
                $(".edit_charge_category").empty();

                $("#EditChargeAdmin-modal").removeClass('hidden').addClass('flex');

                data.charges_category_list.forEach(function (Charges) {
                    $(".edit_charge_category").append(
                        $("<option>").val(Charges.category_id).text(Charges.category)
                    );
                });

                $(".edit_charge_category").val(data.category_id);


            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Data',
                    text: 'No records found!'
                });
            }
        },
        error: function (xhr, errmsg, err) {
            console.error("Error response:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        }
    });

});





// DELETE CHARGESSS
$("#chargesTable1").on("click", "tbody .btn_table_delete_charges_admin", function () {
    var id = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this custome. This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/deleteChargeType',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted Successfully',
                            confirmButtonColor: '#08655D',
                            showConfirmButton: true,
                            confirmButtonText: "Ok"
                        }).then(function() {
                            window.location.reload(); // Reload the page after successful deletion
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.error_message || 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr, errmsg, err) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while trying to delete the item.'
                    });
                }
            });
        }
    });
});








// ************************************************ DISCOUNT


$("#chargesTable2").on("click", "tbody .btn_table_edit_discount_admin", function () {
    var data_table_modal_id = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/EditDiscountAdmin',
        data: { data_table_modal_id: data_table_modal_id },
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $(".edit_discount_id").val(data.charge_discount_id);
                $(".edit_discount_description").val(data.discount_description);
                $(".edit_discount_num").val(data.discount_num);
                $("#EditDiscountAdmin-modal").removeClass('hidden').addClass('flex');
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Data',
                    text: 'No records found!'
                });
            }
        },
        error: function (xhr, errmsg, err) {
            console.error("Error response:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        }
    });
});


$("#chargesTable2").on("click", "tbody .btn_table_delete_discount_admin", function () {
    var charge_discount_id = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this custome. This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/deleteAdminDiscount',
                data: {
                    charge_discount_id: charge_discount_id,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted Successfully',
                            confirmButtonColor: '#08655D',
                            showConfirmButton: true,
                            confirmButtonText: "Ok"
                        }).then(function() {
                            window.location.reload(); // Reload the page after successful deletion
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.error_message || 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr, errmsg, err) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while trying to delete the item.'
                    });
                }
            });
        }
    });
});
















    $('[data-modal-hide]').on('click', function () {
        var modalId = $(this).data('modal-hide');
        $('#' + modalId).addClass('hidden').removeClass('flex');
    });
    

    // document end
});
