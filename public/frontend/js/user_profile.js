//HÀNH ĐỘNG SHOW FORM ĐIỀN THÔNG TIN ADDRESS - VALIDATE CÁC Ô TRONG FORM ĐÓ - SAU KHI THÊM XONG THÌ RESET LẠI
function showAddressCard() {
    document.getElementById("address-card").style.display = "block";
}

function addAddress() {
    var fullName = document.getElementById("full-name").value;
    var phone = document.getElementById("phone").value;
    var addressDetail = document.getElementById("address-detail").value;
    var addressText = fullName + " - " + phone + " - " + addressDetail;

    var isValid = validateInputs();
    if (!isValid) {
        return;
    }

    var existingAddresses = document.getElementById("existing-addresses");
    var addressItem = document.createElement("div");
    addressItem.classList.add("address-item");

    var addressRadio = document.createElement("input");
    addressRadio.type = "radio";
    addressRadio.name = "address";
    addressRadio.value = addressText;
    addressItem.appendChild(addressRadio);

    var addressLabel = document.createElement("label");
    addressLabel.innerHTML = addressText;
    addressItem.appendChild(addressLabel);

    existingAddresses.appendChild(addressItem);

    resetForm();
}

function resetForm() {
    var fullName = document.getElementById("full-name");
    var phone = document.getElementById("phone");
    var addressDetail = document.getElementById("address-detail");

    fullName.value = "";
    phone.value = "";
    addressDetail.value = "";

    fullName.classList.remove("is-invalid");
    phone.classList.remove("is-invalid");
    addressDetail.classList.remove("is-invalid");

    document.getElementById("full-name-error").textContent = "";
    document.getElementById("phone-error").textContent = "";
    document.getElementById("address-detail-error").textContent = "";
}


function validateInputs() {
    var fullName = document.getElementById("full-name");
    var phone = document.getElementById("phone");
    var addressDetail = document.getElementById("address-detail");
    var isValid = true;

    if (fullName.value.trim() === "") {
        fullName.classList.add("is-invalid");
        isValid = false;
    } else {
        fullName.classList.remove("is-invalid");
        document.getElementById("full-name-error").textContent = "";
    }

    // if (phone.value.trim() === "") {
    //     phone.classList.add("is-invalid");
    //     isValid = false;
    // } else {
    //     phone.classList.remove("is-invalid");
    //     document.getElementById("phone-error").textContent = "";
    // }

    if (phone.value.trim() === "") {
        phone.classList.add("is-invalid");
        isValid = false;
    } else if (!phone.value.match(/^\d{10,12}$/)) {
        phone.classList.add("is-invalid");
        document.getElementById("phone-error").textContent = "Vui lòng nhập số điện thoại hợp lệ (từ 10 đến 12 chữ số).";
        isValid = false;
    } else {
        phone.classList.remove("is-invalid");
        document.getElementById("phone-error").textContent = "";
    }

    if (addressDetail.value.trim() === "") {
        addressDetail.classList.add("is-invalid");
        isValid = false;
    } else {
        addressDetail.classList.remove("is-invalid");
        document.getElementById("address-detail-error").textContent = "";
    }

    return isValid;
}






// HÀNH ĐỘNG KIỂM TRA CÁC Ô RADIO BUTTON TRONG MỤC HIỂN THỊ ĐỊA CHỈ ĐÃ CCOS 
// Truy cập tất cả các radio button trong phần HTML
var radioButtons = document.querySelectorAll('input[name="address"]');

// Kiểm tra xem radio buttons có tồn tại
if (radioButtons.length > 0) {
    // Mặc định chọn radio button đầu tiên
    radioButtons[0].checked = true;
}

// Xử lý sự kiện khi radio button được chọn
radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        if (this.checked) {
            // Cập nhật trạng thái "checked" của radio button
            radioButtons.forEach(function(rb) {
                rb.checked = (rb === this);
            }, this);

            // Lưu giá trị của radio button vào biến hoặc cơ sở dữ liệu
            var selectedValue = this.value;
            // Lưu giá trị vào biến hoặc cơ sở dữ liệu tùy thuộc vào nhu cầu của bạn
        }
    });
});





// VALIDATE KIỂM TRA TRA TRONG FORM ĐỔI MẬT KHẨU 
// $(document).ready(function() {
//     // Đăng ký sự kiện click cho nút "Update Password"
//     $('#update-password-btn').click(function() {
//         var oldPassword = $('#old-password').val();
//         var newPassword1 = $('#new-password-1').val();
//         var newPassword2 = $('#new-password-2').val();

//         var passwordError = $('#password-error');

//         // Reset error message
//         passwordError.empty();

//         // Kiểm tra các trường nhập liệu không được để trống
//         if (oldPassword === '' || newPassword1 === '' || newPassword2 === '') {
//             passwordError.text('Hãy điền đầy đủ các ô trống');
//             return;
//         }

//         // kiểm tra mật khẩu mới không được giống mật khẩu cũ 
//         if (newPassword1 === oldPassword) {
//             passwordError.text('Mật khẩu mới không được trùng mật khẩu cũ');
//             return;
//         }

//         // Kiểm tra xác nhận mật khẩu mới
//         if (newPassword1 !== newPassword2) {
//             passwordError.text('Mật khẩu xác nhận không giống mật khẩu mới');
//             return;
//         }


//         // Thực hiện logic cập nhật mật khẩu tại đây...


//         // Xóa giá trị các trường nhập liệu
//         $('#old-password').val('');
//         $('#new-password-1').val('');
//         $('#new-password-2').val('');

//         // Hiển thị thông báo thành công hoặc thực hiện các hành động khác
//         // ...

//         // Đưa ra thông báo thành công
//         passwordError.text('Cập nhật mật khẩu mới thành công').removeClass('text-danger').addClass('text-success');
//     });
// });




//VALIDATE FORM THÔNG TIN CÁ NHÂN
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('update-profile-btn').addEventListener('click', function() {
        var fullNameInput = document.getElementById('fullName');
        var phoneNumberInput = document.getElementById('phoneNumber');
        var fullNameError = document.getElementById('fullNameError');
        var phoneNumberError = document.getElementById('phoneNumberError');

        // Xóa các thông báo lỗi hiện tại
        fullNameError.textContent = '';
        phoneNumberError.textContent = '';

        // Kiểm tra trường "Full Name" không được để trống
        if (fullNameInput.value.trim() === '') {
            fullNameError.textContent = 'Hãy điền Tên của bạn';
            fullNameInput.classList.add('is-invalid');
        } else {
            fullNameInput.classList.remove('is-invalid');
        }

        // Kiểm tra trường "Phone Number" không được để trống và phải là số điện thoại
        var phoneNumberPattern = /^\d{10}$/; // Mẫu số điện thoại: 10 chữ số
        if (phoneNumberInput.value.trim() === '') {
            phoneNumberError.textContent = 'Hãy điền số điện thoại của bạn';
            phoneNumberInput.classList.add('is-invalid');
        } else if (!phoneNumberPattern.test(phoneNumberInput.value)) {
            phoneNumberError.textContent = 'Hãy điền số điện thoại chính xác';
            phoneNumberInput.classList.add('is-invalid');
        } else {
            phoneNumberInput.classList.remove('is-invalid');
        }

        // Kiểm tra nếu không có lỗi thì tiến hành cập nhật profile
        if (!fullNameInput.classList.contains('is-invalid') && !phoneNumberInput.classList.contains('is-invalid')) {
            // Thực hiện cập nhật profile tại đây
            // ...

            // Sau khi cập nhật thành công, bạn có thể thực hiện các hành động khác, ví dụ: hiển thị thông báo thành công, chuyển hướng trang, v.v.
        }
    });

    $(document).ready(function() {
        $('.order-detail-link').click(function(e) {
            e.preventDefault();
            var orderId = $(this).data('order-id');

            $.ajax({
                url: '/user/order-detail/' + orderId,
                method: 'GET',
                success: function(response) {
                    $('.modal-body .order_number').text(response.data.order_number);
                    $('.modal-body .delivery_date').text(response.data.delivery_date);
                    $('.modal-body .status').text(response.data.status);
                    $('.modal-body .name').text(response.data.name);
                    $('.modal-body .email').text(response.data.email);
                    $('.modal-body .phone').text(response.data.phone);
                    $('.modal-body .payment_method').text(response.data.payment_method);
                    $('.modal-body .detail_address').text(response.data.detail_address);

                    var orderItemContainer = $('.modal-body #order_product');
                    orderItemContainer.empty(); // Xóa các phần tử hiện tại trong container
                    var orderItemQtyContainer = $('.modal-body #order_product_quantity');
                    orderItemQtyContainer.empty(); // Xóa các phần tử hiện tại trong container
                    // Duyệt qua danh sách listProductName và thêm vào container
                    var listProductName = response['listProductName'];
                    for (var i = 0; i < listProductName.length; i++) {
                        var productName = listProductName[i];
                        var orderItem = $('<p class="order-item"><span>' + productName + '</span></p>');
                        orderItemContainer.append(orderItem);
                    }
                    var listProductQty = response['listQtyCart'];
                    console.log(listProductQty);
                    for (var i = 0; i < listProductQty.length; i++) {
                        var productQty = listProductQty[i];
                        var orderItemqty = $('<p class="order-item-quantity"><span>' + productQty + '</span></p>');
                        orderItemQtyContainer.append(orderItemqty);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('input[name="use"]').on('change', function() {
            var addressId = $(this).data('id');

            // Gửi AJAX request đến server
            $.ajax({
                url: '/user/update-default-address',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    address_id: addressId
                },
                success: function(response) {
                    // Xử lý phản hồi từ server (nếu cần)
                    console.log(response);
                },
                error: function(error) {
                    // Xử lý lỗi (nếu có)
                    console.error(error);
                }
            });
        });
    });




});


// đoạn code lọc theo filter orders
function updateFilter(filterName) {
    document.getElementById("dropdownMenuButton").innerHTML = filterName;
}

function filterOrders(status) {
    var tableRows = document.querySelectorAll('#orderTable tbody tr');
    tableRows.forEach(function(row) {
        var rowStatus = row.getAttribute('data-status');
        if (status === 'all' || status === 'all orders' || rowStatus === status) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var selectedStatus = this.textContent.toLowerCase();
            filterOrders(selectedStatus);
        });
    });
});