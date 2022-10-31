$(document).ready(function () {

    $('.btnThem').click(function () {
        $('.maDonVi, .tenDonVi, .viTri').val('');
        $('#modalThem .modal-title').text('Thêm thông tin Đơn vị/Khoa chuyên môn');
        $('.btnLuu').attr('type', 'insert');
        $('#modalThem').modal('show');
    });

    $(document).on('click', '.itemCapNhat', function () {
        var data = JSON.parse($(this).attr('data'));
        $('.maDonVi').val(data.ma_don_vi);
        $('.tenDonVi').val(data.ten_don_vi);
        $('.viTri').val(data.vi_tri);
        $('.khoaChuyenMon').prop('checked', parseInt(data.khoa_chuyen_mon) === 1);
        $('#modalThem .modal-title').text('Cập nhật thông tin Đơn vị/Khoa chuyên môn');
        $('.btnLuu').attr('data', data.id_don_vi).attr('type', 'update');
        $('#modalThem').modal('show');
    });

    $('.btnLuu').click(function () {

        if (isNULLorEmpty($('.maDonVi').val())) {
            toastr.error("Mã đơn vị không được bỏ trống", "Thao tác thất bại");
            return;
        }

        if (isNULLorEmpty($('.tenDonVi').val())) {
            toastr.error("Tên đơn vị không được bỏ trống", "Thao tác thất bại");
            return;
        }

        switch ($(this).attr('type')) {
            case 'insert':
                $.ajax({
                    url: PUT_DON_VI,
                    type: "PUT",
                    data: {
                        'ma_don_vi': $('.maDonVi').val(),
                        'ten_don_vi': $('.tenDonVi').val(),
                        'vi_tri': $('.viTri').val(),
                        'khoa_chuyen_mon': $('.khoaChuyenMon').is(":checked") === true ? 1 : 0,
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
                break;

            case 'update':
                var id_don_vi = $(this).attr('data');
                $.ajax({
                    url: POST_DON_VI,
                    type: "POST",
                    data: {
                        'id_don_vi': id_don_vi,
                        'ma_don_vi': $('.maDonVi').val(),
                        'ten_don_vi': $('.tenDonVi').val(),
                        'vi_tri': $('.viTri').val(),
                        'khoa_chuyen_mon': $('.khoaChuyenMon').is(":checked") === true ? 1 : 0,
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
                break;
        }
    });

    $('.itemXoa').click(function () {

        if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
            return;
        }

        var id = $(this).attr('data');
        $.ajax({
            url: DELETE_DON_VI,
            type: "DELETE",
            data: {
                'id_don_vi': id,
            },
            success: function (result) {
                result = JSON.parse(result);
                if (result.status === 200) {
                    toastr.success(result.message, "Thao tác thành công");
                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                } else {
                    toastr.error(result.message, "Thao tác thất bại");
                }
            }
        });
    });
});
