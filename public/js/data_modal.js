$(document).ready(function() {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




    // EDIT
    $(".default_datatable1").on("click", "tbody .btn_table_modal_edit", function () {
        var data_table_modal_id = $(this).attr('data-id');
        console.log("Data ID being sent:", data_table_modal_id);
    
        $.ajax({
            type: 'POST',
            url: '/EditModal',
            data: { data_table_modal_id: data_table_modal_id },
            dataType: 'json',
            success: function (data) {
                console.log("AJAX Response:", data); // Log the response
                if (data.success) {
                    $(".id_edit").val(data.id);
                    $(".edit_Cfirstname").val(data.firstname);
                    $(".edit_Clastname").val(data.lastname);
                    $("#EditData-modal").removeClass('hidden').addClass('flex');
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
    



    
    // Event listener for closing the modal
    $('[data-modal-hide]').on('click', function () {
        var modalId = $(this).data('modal-hide');
        $('#' + modalId).addClass('hidden').removeClass('flex');
    });
    
    



    

    // DELETE ROOM ADMIN

    $(".default_datatable_roomList").on("click", "tbody .btn_table_modal_delete", function () {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete this data. This action cannot be undone!`,
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
                    url: '/deleteRoom',
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
       // END DELETE ROOM ADMIN


    

    // $('[data-modal-hide]').on('click', function () {
    //     var modalId = $(this).data('modal-hide');
    //     $('#' + modalId).addClass('hidden').removeClass('flex');
    // });




    $(".default_datatable_roomList").on("click", "tbody .btn_table_modal_edit", function () {
        var data_table_modal_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: '/EditRoom',
            data: { data_table_modal_id: data_table_modal_id },
            dataType: 'json',
            success: function (data) {
                // console.log("AJAX Response:", data);
                if (data.success) {
                    $(".id_edit_room").val(data.id);
                    $(".edit_room_number").val(data.room_number);
                    $(".edit_rate_type").val(data.rate_type);
                    $(".edit_adult_rate").val(data.adult_rate);
                    $(".edit_children_rate").val(data.children_rate);
                    $(".edit_room_rate").val(data.room_rate);
                    $(".edit_no_of_person").val(data.no_of_person);
                    $(".edit_room_type").empty();
                    $(".edit_room_status").empty();

                    data.room_types.forEach(function (roomType) {
                        $(".edit_room_type").append(
                            $("<option>").val(roomType.room_type_id).text(roomType.room_type)
                        );
                    });

                    data.statuses.forEach(function (roomStatus) {
                        $(".edit_room_status").append(
                            $("<option>").val(roomStatus.status_id).text(roomStatus.status)
                        );
                    });
             
                    $(".edit_room_type").val(data.room_type_id);
                    $(".edit_room_status").val(data.status_id);
                    $("#EditRoom-modal").removeClass('hidden').addClass('flex');
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
    

    











// VIEW CHECKIN 

$(".default_datatable_roomList").on("click", "tbody .btn_table_modal_view_checkin", function () {
    var data_table_modal_id = $(this).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/viewCheckinModal',  
        data: {data_table_modal_id: data_table_modal_id},
        dataType: 'json',
   
        success: function (data) {
            if (data.success) {
                $(".checkin_view_folio_number").val(data.folio_number);
                $(".checkin_view_firstname").val(data.first_name);
                $(".checkin_view_lastname").val(data.last_name);
                $(".checkin_view_address").val(data.address);
                $(".checkin_view_country").val(data.country);
                $(".checkin_view_company").val(data.company);
                $(".checkin_view_roomnum").val(data.room_number);
                $(".checkin_view_datein").val(formatDate(data.date_in));
                $(".checkin_view_no_of_days").val(data.no_of_days);
                $(".checkin_view_no_of_adults").val(data.no_of_adults);
                $(".checkin_view_no_of_children").val(data.no_of_children);
                $(".checkin_view_business_source").val(data.business_source);
                $(".checkin_view_date_out").val(formatDate(data.date_out));
                $(".checkin_view_rate_period").val(data.rate_period);
                $(".checkin_view_total_charges").val(data.total_charges);
                $(".checkin_view_other_charges").val(data.other_charges);
                $(".checkin_view_sub_total").val(data.sub_total);
                $(".checkin_view_discount").val(data.discount_description);
                $(".checkin_view_total").val(data.total);
                $(".checkin_view_amount_paid").val(data.amount_paid);
                $(".checkin_view_balance").val(data.balance);
                $(".checkin_view_id_type").val(data.id_type);
                $(".checkin_view_id_number").val(data.id_number);
                $(".checkin_view_vehicle_model").val(data.vehicle_model);
                $(".checkin_view_vehicle_plate_no").val(data.vehicle_plate_no);
                $(".checkin_view_reference_num_receipt").val(data.reference_num_receipt);
                $("#checkinView-modal").removeClass('hidden').addClass('flex');
            

            } else {
                alert("error")
            }
        },
        error: function (xhr, errmsg, err) {
            alert("error")
        }
    });

});

function formatDate(dateStr) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', options);
}








    // EDIT CHECK IN 
    $(".default_datatable_roomList").on("click", "tbody .btn_table_modal_edit_checkin", function () {
        var data_table_modal_id = $(this).attr("data-id");
    
        $.ajax({
            type: "POST",
            url: "/EditCheckIn",
            data: { data_table_modal_id: data_table_modal_id },
            dataType: "json",
            success: function (data) {
                console.log("AJAX Response:", data);
                if (data.success) {
                    // Populate the fields
                    $(".edit_checkin_folio_number").val(data.folio_number);
                    $(".edit_checkin_firstname").val(data.first_name);
                    $(".edit_checkin_lastname").val(data.last_name);
                    $(".edit_checkin_address").val(data.address);
                    $(".edit_checkin_datein").val(data.date_in);
                    $(".edit_checkin_no_of_days").val(data.no_of_days);
                    $(".edit_checkin_no_of_adults").val(data.no_of_adults);
                    $(".edit_checkin_no_of_children").val(data.no_of_children);
                    $(".edit_checkin_dateout").val(data.date_out);
                    $(".edit_checkin_id_type").val(data.id_type);
                    $(".edit_checkin_id_number").val(data.id_number);
                    $(".edit_checkin_vehicle_model").val(data.vehicle_model);
                    $(".edit_checkin_vehicle_plate_no").val(data.vehicle_plate_no);
                    $(".edit_checkin_rate_period").val(data.rate_period);
                    $(".edit_checkin_total_charges").val(data.total_charges);
                    $(".edit_checkin_other_charges").val(data.other_charges);
                    $(".edit_checkin_sub_total").val(data.sub_total);
                    $(".edit_checkin_total").val(data.total);
                    $(".edit_checkin_amount_paid").val(data.amount_paid);
                    $(".edit_checkin_balance").val(data.balance);
                    $(".edit_checkin_bank").val(data.bank);
                    $(".edit_checkin_card_type").val(data.card_type);
                    $(".edit_checkin_reference_num").val(data.reference_num);
                    $(".edit_discount_amount").val(data.amount_discounted);
                    $(".edit_no_of_sc_pwd").val(data.no_of_sc_pwd);
                    $(".edit_bod_no_of_sc_pwd").val(data.bod_no_of_sc_pwd);
                    $(".edit_bod_discount_type").val(data.bod_discount_type);
                    $(".edit_checkin_reference_num_receipt").val(data.reference_num_receipt);

                    // Populate dropdowns
                    $(".edit_checkin_discount").empty();
                    $(".edit_checkin_business_source_id").empty();
                    $(".edit_checkin_country").empty();
                    $(".edit_checkin_company").empty();
                    $(".edit_checkin_room").empty();
                    $("#editCheckIn-modal").removeClass("hidden").addClass("flex");


              
    
                    data.countries.forEach(function (Country) {
                        $(".edit_checkin_country").append(
                            $("<option>").val(Country.country_id).text(Country.country)
                        );
                    });
    
                    data.companies.forEach(function (Company) {
                        $(".edit_checkin_company").append(
                            $("<option>").val(Company.company_id).text(Company.company)
                        );
                    });
    
                    // data.rooms.forEach(function (Room) {
                    //     $(".edit_checkin_room").append(
                    //         $("<option>").val(Room.id).text(Room.room_number + " - " + Room.rate_type)
                    //         .attr("data-room-rate",Room.room_rate)
                    //         .attr("data-adult-rate",Room.adult_rate)
                    //         .attr("data-children-rate",Room.children_rate)
                    //     );
                    // });




                    $(".edit_checkin_room").append(
                        $("<option>").val("").text("Select Rooms").prop("disabled", true).prop("selected", true)
                    );
                    
                    data.rooms.forEach(function (Room) {
                        let option = $("<option>")
                            .val(Room.id)
                            .text(Room.room_number + " - " + Room.rate_type + " " + Room.no_of_person)
                            .attr("data-room-rate", Room.room_rate)
                            .attr("data-adult-rate", Room.adult_rate)
                            .attr("data-children-rate", Room.children_rate)
                            .attr("data-no-person", Room.no_of_person);
                            
                        if (Room.id === data.id) {
                            option.prop("selected", true);
                        }
                        $(".edit_checkin_room").append(option);
                    });
    
                    data.business.forEach(function (Business) {
                        $(".edit_checkin_business_source_id").append(
                            $("<option>").val(Business.business_source_id).text(Business.business_source)
                        );
                    });
    
                    data.discounts.forEach(function (Discount) {
                        $(".edit_checkin_discount").append(
                            $("<option>").val(Discount.charge_discount_id).text(Discount.discount_description + "-" + Discount.discount_num).attr("data-discount-num", Discount.discount_num).attr("data-discount-id", Discount.charge_discount_id)
                        );
                    });
                    
                    $("#swipe_transaction_editModal").toggleClass("hidden", data.charge_discount_id !== 3);
                    $("#sc_pwd_editModal").toggleClass("hidden", data.charge_discount_id !== 2);
                    $("#bod_editModal").toggleClass("hidden", data.charge_discount_id !== 4);



                 // INNER MODAL
                $("#charges-table-body2").empty();
                data.charge_type_list.forEach(function (chargeType) {
                    var row = $("<tr>");
                    row.append(
                        $("<td>").text(chargeType.category), // Category
                        $("<td>").text(chargeType.charge_description), // Charge Description
                        $("<td>").append(
                            $("<input>")
                                .attr("type", "number")
                                .attr("value", chargeType.category === 'F&B' ? 1 : chargeType.quantity) // Set initial quantity value
                                .attr("min", "0") // Ensure the value can't be negative
                                .addClass("quantity-input") // Class for the quantity input
                                .data("price", chargeType.price) // Store the price as data attribute
                                .data("category", chargeType.category) // Store the category as data attribute
                                .prop("readonly", chargeType.category === 'F&B') // Make quantity readonly for F&B
                                .addClass("border rounded px-1 py-1 w-20 text-center focus:outline-none focus:ring focus:ring-blue-300")
                        ),
                        $("<td>").append(
                            chargeType.category === 'F&B' 
                                ? $("<input>")
                                    .attr("type", "number")
                                    .attr("value", chargeType.price) // Set initial price value for F&B
                                    .attr("min", "0") // Ensure the value can't be negative
                                    .addClass("price-input") // Class for the price input
                                    .addClass("border rounded px-1 py-1 w-20 text-center focus:outline-none focus:ring focus:ring-blue-300")
                                : chargeType.price // Static price for non-F&B items
                        )
                    );
                    $("#charges-table-body2").append(row);
                });



                function calculateTotal() {
                    var totalAmount = parseFloat($(".edit_checkin_other_charges").val()) || 0;

                    $(".quantity-input").each(function () {
                        var quantity = $(this).val();
                        var price = $(this).data("price");
                        var category = $(this).data("category");

                        // For F&B, use the price input value instead of the static price
                        if (category === 'F&B') {
                            price = $(this).closest('tr').find('.price-input').val() || 0;
                        }

                        if (!isNaN(quantity) && !isNaN(price) && quantity > 0) {
                            totalAmount += parseFloat(price) * parseInt(quantity); // Update total price dynamically
                        }
                    });

                    $(".total-amountchargesEdit").text(totalAmount.toFixed(2)); // Format to two decimal places
                }

                calculateTotal();

                // Event listeners for quantity and price inputs
                $(".quantity-input, .price-input").on("input", function () {
                    calculateTotal();
                });

                // Save button click handler
                $("#save-charges-btn").on("click", function (event) {
                    event.preventDefault();

                    var folioNumber = $(".edit_checkin_folio_number").val();
                    var totalAmount = parseFloat($(".total-amountchargesEdit").text());

                    $.ajax({
                        url: 'storeOtherchargesEdit',
                        method: 'POST',
                        data: {
                            folio_number: folioNumber,
                            other_charges: totalAmount,
                        },
                        success: function (response) {
                            $(".edit_checkin_other_charges").val(totalAmount.toFixed(2));
                            calculateFields();

                         

                            Swal.fire({
                                icon: "success",
                                title: "Update Other Charges",
                                text: "Save successfully!",
                            });

                            hideModal('nested-modal-id2');
                        },
                        error: function (xhr, status, error) {
                            console.error("Error saving data", error);
                            var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An unknown error occurred.";
                            alert("Error: " + errorMessage);
                        }
                    });
                });

                $("#edit_checkin_other_charges").on("input", function () {
                    calculateTotal();
                });
                // END INNER MODAL
             
    
    
                    $(".edit_checkin_discount").val(data.charge_discount_id);
                    $(".edit_checkin_business_source_id").val(data.business_source_id);
                    $(".edit_checkin_country").val(data.country_id);
                    $(".edit_checkin_company").val(data.company_id);
                    $(".edit_checkin_room").val(data.id);
    
             
                  
                    const noOfDaysInput          = document.getElementById("edit_checkin_no_of_days");
                    const ratePeriodInput        = document.getElementById("edit_checkin_rate_period");
                    const totalChargesInput      = document.getElementById("edit_checkin_total_charges");
                    const otherChargesInput      = document.getElementById("edit_checkin_other_charges");
                    const subTotalInput          = document.getElementById("edit_checkin_sub_total");
                    const discountInput          = document.getElementById("edit_checkin_discount");
                    const totalInput             = document.getElementById("edit_checkin_total");
                    const amountPaidInput        = document.getElementById("edit_checkin_amount_paid");
                    const balanceInput           = document.getElementById("edit_checkin_balance");
                    const roomInput              = document.getElementById("edit_checkin_room");
                    const adultRateInput         = document.getElementById("edit_checkin_no_of_adults");
                    const childrenRateInput      = document.getElementById("edit_checkin_no_of_children");
                    const discounted_AmountInput = document.getElementById("edit_discount_amount");
                  
                    const no_of_sc_pwdInput      = document.getElementById("edit_no_of_sc_pwd");
                    const bod_discount_type_Input = document.getElementById("edit_bod_discount_type");
                    const bod_no_of_sc_pwdInput      = document.getElementById("edit_bod_no_of_sc_pwd");

                    function calculateFields() {
                     
                        const noOfDays    = parseInt(noOfDaysInput.value) || 0;
                        const otherCharges= parseFloat(otherChargesInput.value) || 0;
                        const amountPaid  = parseFloat(amountPaidInput.value) || 0;
                        
                        // Get discount percentage from the selected discount option.
                        // (This time we use the "data-discount" attribute per your formula.)
                        const selectedOption = discountInput.options[discountInput.selectedIndex];
                        const discount = parseFloat(selectedOption.getAttribute("data-discount-num")) || 0;
                        const discountID = parseFloat(selectedOption.getAttribute("data-discount-id")) || 0;
                       
                        // Get room details from the selected room option.
                        const selectedOptionRoom = roomInput.options[roomInput.selectedIndex];
                        const roomRate = parseFloat(selectedOptionRoom.getAttribute("data-room-rate")) || 0;
                        // Get the number of persons allowed in the room.
                        const noOfPersons = parseInt(selectedOptionRoom.getAttribute("data-no-person")) || 1;
                        

                        // Get adult and children rates from the room option.
                        const adultRate    = parseFloat(selectedOptionRoom.getAttribute("data-adult-rate")) || 0;
                        const childrenRate = parseFloat(selectedOptionRoom.getAttribute("data-children-rate")) || 0;
                        const adultRatefinal    = parseInt(adultRateInput.value) || 0;
                        const childrenRatefinal = parseInt(childrenRateInput.value) || 0;

                        // Calculate total charges
                        const totalCharges = (adultRate * adultRatefinal) +
                                            (childrenRate * childrenRatefinal) +
                                            (noOfDays * roomRate);
               
                        //const subTotal = totalCharges;

                      

               
                        const noOfSC_PWD = parseInt(no_of_sc_pwdInput.value) || 0;

                        let discountedTotal = 0;
                        let discountAmount  = 0;
                        let subTotal = 0;
                        let discountAmount2  = 0;

                        if(discountID === 2){
                            const var1 = roomRate / noOfPersons;
                            const var2 = Math.ceil(var1 * noOfSC_PWD);
                            const var3 = var2 / 1.12;
                            const var4 = (var3 * discount) / 100;
                            const ext = var3 - var4;
                            const var5 = noOfPersons - noOfSC_PWD;
                            let final_to =  (var5 * var1) + ext;
                       
                            subTotal = Math.ceil(final_to) * noOfDays;
                            discountedTotal = Math.ceil(subTotal) + otherCharges;
                            discountAmount = totalCharges - subTotal; 
                        }

                        // else if(discountID === 9){
                        //     const var1 = roomRate / 1.12;
                        //     const var2 = (var1 * discount) / 100;
                        //     const var3 = roomRate - var2;
                        //     subTotal = var3 * noOfDays;
                        //     discountedTotal = subTotal + otherCharges;
                   
                        //     discountAmount = var2 * noOfDays;
                        // }

                        else if(discountID === 9){
                            const var1 = roomRate / 1.12;
                            const var2 = (var1 * discount) / 100;
                            const var3 = Number((roomRate - var2).toFixed(2));
                            subTotal = var3 * noOfDays;
                            discountedTotal = subTotal + otherCharges;
                            discountAmount = totalCharges * subTotal;
                        }


                        else if (discountID === 4 && (parseInt(bod_no_of_sc_pwdInput.value) || 0) === 0) {
                            const selectedTransactionType = parseFloat(bod_discount_type_Input?.value) || 0;
                        
                            if (selectedTransactionType === 10) {
                                discountAmount2 = (roomRate * 10) / 100; 
                                discountAmount = ((roomRate * 10) / 100) * noOfDays; 
                            } else if (selectedTransactionType === 5) {
                                discountAmount2 = (roomRate * 5) / 100;
                                discountAmount = ((roomRate * 5) / 100) * noOfDays;
                            } else if (selectedTransactionType === 15) {
                                discountAmount2 = (roomRate * 15) / 100; 
                                discountAmount = ((roomRate * 15) / 100) * noOfDays; 
                            } else {
                                discountAmount2 = 0; 
                            }
                            subtotal2 = (roomRate - discountAmount2 ) * noOfDays;
                            subTotal = Math.round(subtotal2);
                            discountedTotal2 = subTotal + otherCharges;
                            discountedTotal = Math.round(discountedTotal2);
                        }


                        
                        else if (discountID === 4 && (parseInt(bod_no_of_sc_pwdInput.value) || 0) !== 0) {
                            const selectedTransactionType = parseFloat(bod_discount_type_Input?.value) || 0;
                            const noOfSC_PWD_BOD = parseInt(bod_no_of_sc_pwdInput.value) || 0;
                        
                            const var1 = (roomRate * selectedTransactionType) / 100; 
                            const ext = roomRate - var1;
                            const var2 = ext / noOfPersons; 
                            const var3 = var2 / 1.12; 
                            const var4 = (var3 * 20) / 100; 
                            const var5 = noOfPersons - noOfSC_PWD_BOD; 
                        
                
                            subtotal2 = (var5 === 0 ? (var3 - var4) * 2 : ((var2 * var5) + (var3 - var4))) * noOfDays;
                            subTotal = Math.round(subtotal2);
                            discountedTotal2 = subTotal + otherCharges;
                            discountedTotal = Math.round(discountedTotal2);
                            discountAmount = totalCharges - subTotal; 
                           
                        }
                        

                        
                        else{
                            
                            discountAmount2  = (roomRate * discount) / 100;
                            subTotal = (roomRate  - discountAmount2) * noOfDays;
                            discountedTotal = subTotal + otherCharges;
                            discountAmount = totalCharges - subTotal; 
                        }

                      
                        ratePeriodInput.value        = roomRate.toFixed(2);
                        totalChargesInput.value      = totalCharges.toFixed(2);
                        subTotalInput.value          = subTotal.toFixed(2);
                        totalInput.value             = discountedTotal.toFixed(2);
                        balanceInput.value           = (discountedTotal - amountPaid).toFixed(2);
                        discounted_AmountInput.value = discountAmount.toFixed(2);
                    }

                    
                    adultRateInput.addEventListener("input", calculateFields);
                    childrenRateInput.addEventListener("input", calculateFields);
                    noOfDaysInput.addEventListener("input", calculateFields);
                    otherChargesInput.addEventListener("input", calculateFields);
                    discountInput.addEventListener("input", calculateFields);
                    amountPaidInput.addEventListener("input", calculateFields);
                    roomInput.addEventListener("change", calculateFields);
                    no_of_sc_pwdInput.addEventListener("input", calculateFields);
                    bod_discount_type_Input.addEventListener("input",calculateFields);
                    bod_no_of_sc_pwdInput.addEventListener("input",calculateFields);
                   
                    calculateFields();


                    
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "No Data",
                        text: "No records found!",
                    });
                }
            },
            error: function (xhr, errmsg, err) {
                console.error("Error response:", xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            },
        });
    });
    








    $(".default_datatable_roomList").on("click", "tbody .btn_table_modal_delete_checkin", function () {
        var folio_number = $(this).attr('data-id');
        var data_room = $(this).attr('data-room');

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete this data. This action cannot be undone!`,
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
                    url: '/deleteCheckIn',
                    data: {
                        folio_number: folio_number,
                        data_room:data_room,
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
    








      // VIEW CHECK OUT MODAL 
      $(".default_datatable_roomList").on("click", "tbody .btn_table_modal_view_checkout", function () {
        var data_table_modal_id = $(this).attr('data-id');
    
        $.ajax({
            type: 'POST',
            url: '/viewCheckOutModal',  
            data: {data_table_modal_id: data_table_modal_id},
            dataType: 'json',
       
            success: function (data) {
                if (data.success) {
                    $(".checkout_view_folio_number").val(data.folio_number);
                    $(".checkout_view_firstname").val(data.first_name);
                    $(".checkout_view_lastname").val(data.last_name);
                    $(".checkout_view_no_of_days").val(data.no_of_days);
                    $(".checkout_view_rate_period").val(data.rate_period);
                    $(".checkout_view_total_charges").val(data.total_charges);
                    $(".checkout_view_other_charges").val(data.other_charges);
                    $(".checkout_view_sub_total").val(data.sub_total);
                    $(".checkout_view_discount").val(data.discount);
                    $(".checkout_view_total").val(data.total);
                    $(".checkout_view_amount_paid").val(data.amount_paid);
                    $(".checkout_view_balance").val(data.balance);
                    $(".checkout_view_room").val(data.room_id);
                    $("#checkOut-modal").removeClass('hidden').addClass('flex');
                
    
                } else {
                    alert("error")
                }
            },
            error: function (xhr, errmsg, err) {
                alert("error")
            }
        });
    
    });

    // END OF VIEW CHECK OUT MODAL























// CHECKIN FROM RESERVE
$("#reservationList").on("click", "tbody .btn_table_modal_view_checkin_reserved", function () {
    var data_table_modal_id = $(this).attr('data-id');
  
    $.ajax({
        type: 'POST',
        url: '/CheckInFromReservation',  
        data: {data_table_modal_id: data_table_modal_id},
        dataType: 'json',
   
        success: function (data) {
            if (data.success) {
                $("#checkinFromReserve_folio_number_input").val(data.folio_number);
                $(".checkinFromReserve_folio_number").text(data.folio_number);
                $(".checkinFromReserve_name").text(data.first_name + ' '+ data.last_name);
                $("#checkinFromReserve_room_number_input").val(data.room_id);
                $("#checkInFromReserve-modal").removeClass('hidden').addClass('flex');

           
            
            

            } else {
                alert("error")
            }
        },
        error: function (xhr, errmsg, err) {
            alert("error")
        }
    });

});
// END OF CHECKIN FROM RESERVE














// DELETE RESERVATION 



$("#reservationList").on("click", "tbody .btn_table_modal_delete_checkin_reserved", function () {
    var folio_number = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this data. This action cannot be undone!`,
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
                url: '/deleteReservation',
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




// END OF DELETE RESERVATION


















// EDIT CHECKOUT DETAILS
$("#checkoutList_datatable").on("click", "tbody .btn_table_modal_edit_checkout", function () {
    var data_table_modal_id = $(this).attr("data-id");

    $.ajax({
        type: "POST",
        url: "/EditCheckOut",
        data: { data_table_modal_id: data_table_modal_id },
        dataType: "json",
        success: function (data) {
            console.log("AJAX Response:", data);
            if (data.success) {
          
                $(".edit_checkout_folio_number").val(data.folio_number);
                $(".edit_checkout_firstname").val(data.first_name);
                $(".edit_checkout_lastname").val(data.last_name);
                $(".edit_checkout_address").val(data.address);
                $(".edit_checkout_datein").val(data.date_in);
                $(".edit_checkout_no_of_days").val(data.no_of_days);
                $(".edit_checkout_no_of_adults").val(data.no_of_adults);
                $(".edit_checkout_no_of_children").val(data.no_of_children);
                $(".edit_checkout_dateout").val(data.date_out);
                $(".edit_checkout_id_type").val(data.id_type);
                $(".edit_checkout_id_number").val(data.id_number);
                $(".edit_checkout_vehicle_model").val(data.vehicle_model);
                $(".edit_checkout_vehicle_plate_no").val(data.vehicle_plate_no);
                $(".edit_checkout_rate_period").val(data.rate_period);
                $(".edit_checkout_total_charges").val(data.total_charges);
                $(".edit_checkout_other_charges").val(data.other_charges);
                $(".edit_checkout_sub_total").val(data.sub_total);
                $(".edit_checkout_total").val(data.total);
                $(".edit_checkout_amount_paid").val(data.amount_paid);
                $(".edit_checkout_balance").val(data.balance);
                $(".edit_checkout_bank").val(data.bank);
                $(".edit_checkout_card_type").val(data.card_type);
                $(".edit_checkout_reference_num").val(data.reference_num);
                $(".edit_checkout_discount_amount").val(data.amount_discounted);
                $(".edit_checkout_no_of_sc_pwd").val(data.no_of_sc_pwd);
                $(".edit_checkout_bod_no_of_sc_pwd").val(data.bod_no_of_sc_pwd);
                $(".edit_checkout_bod_discount_type").val(data.bod_discount_type);
                $(".edit_checkout_reference_num_receipt").val(data.reference_num_receipt);



                $(".edit_checkout_country").empty();
                $(".edit_checkout_country").append(
                    $('<option>').val('').text('Select Country').prop('disabled', true)
                ); 

                data.countries.forEach(function (country) {
                    const option = $('<option>')
                        .val(country.country_id)
                        .text(country.country);
                    if (country.country_id == data.country_id) {
                        option.prop('selected', true); 
                    }
                    $(".edit_checkout_country").append(option);
                });


                // company
                $(".edit_checkout_company").empty();
                $(".edit_checkout_company").append(
                    $('<option>')
                        .val('')
                        .text('Select Company')
                        .prop('disabled', true)
                        .prop('selected', data.company_id === null) // Select if company_id is null
                ); 
                
                data.companies.forEach(function (company) {
                    const option = $('<option>')
                        .val(company.company_id)
                        .text(company.company);
                    if (company.company_id == data.company_id) {
                        option.prop('selected', true); // Override if a match is found
                    }
                    $(".edit_checkout_company").append(option);
                });
                
                //business source
                $(".edit_checkout_business_source").empty();
                $(".edit_checkout_business_source").append(
                    $('<option>')
                        .val('')
                        .text('Select Business Source')
                        .prop('disabled', true)
                        .prop('selected', data.business_source_id === null) 
                ); 
                
                data.business.forEach(function (business) {
                    const option = $('<option>')
                        .val(business.business_source_id)
                        .text(business.business_source);
                    if (business.business_source_id == data.business_source_id) {
                        option.prop('selected', true); 
                    }
                    $(".edit_checkout_business_source").append(option);
                });

                // Discount
                $(".edit_checkout_discount").empty();
                $(".edit_checkout_discount").append(
                    $('<option>')
                        .val('')
                        .text('Select Discount')
                        .prop('disabled', true)
                        .prop('selected', data.charge_discount_id === null) // Use charge_discount_id
                ); 
                
                data.discounts.forEach(function (discount_list) {
                    const option = $('<option>')
                        .val(discount_list.charge_discount_id) // Use charge_discount_id from table
                        .text(discount_list.discount_description); // Assuming this field exists
                    if (discount_list.charge_discount_id == data.charge_discount_id) {
                        option.prop('selected', true); 
                    }
                    $(".edit_checkout_discount").append(option);
                });


              
                $("#editCheckOut-modal").removeClass("hidden").addClass("flex");

                
            
                
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "No Data",
                    text: "No records found!",
                });
            }
        },
        error: function (xhr, errmsg, err) {
            console.error("Error response:", xhr.responseText);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            });
        },
    });
});





// DELETE CHECKOUT *************

$("#checkoutList_datatable").on("click", "tbody .btn_table_modal_delete_checkout", function () {
    var folio_number = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this data. This action cannot be undone!`,
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
                url: '/deleteCheckout',
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







    // document end
});