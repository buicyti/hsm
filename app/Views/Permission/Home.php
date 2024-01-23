<?php include_once('app\Views\includes\breadcrumb.php') ?>
<link rel="stylesheet" href="<?= base_url('public/vendor/datatables/css/datatables.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/vendor/select2/css/select2.min.css') ?>">

<style>
div.dataTables_scrollFootInner table.table-bordered tr th:first-child,
div.dataTables_scrollHeadInner table.table-bordered tr th:first-child {
    border-left-color: var(--border-color) !important;
}

.select2-container--default .select2-selection--multiple {
    border-color: var(--border-color);
    background-color: var(--input-background);
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: var(--border-color);
}

.disabled {
    pointer-events: none;
    opacity: .65;
}

.switch {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 32px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMTYiIHdpZHRoPSIxMiIgdmlld0JveD0iMCAwIDM4NCA1MTIiPjwhLS0hRm9udCBBd2Vzb21lIEZyZWUgNi41LjEgYnkgQGZvbnRhd2Vzb21lIC0gaHR0cHM6Ly9mb250YXdlc29tZS5jb20gTGljZW5zZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tL2xpY2Vuc2UvZnJlZSBDb3B5cmlnaHQgMjAyMyBGb250aWNvbnMsIEluYy4tLT48cGF0aCBvcGFjaXR5PSIxIiBmaWxsPSIjZjk1MzYzIiBkPSJNMzQyLjYgMTUwLjZjMTIuNS0xMi41IDEyLjUtMzIuOCAwLTQ1LjNzLTMyLjgtMTIuNS00NS4zIDBMMTkyIDIxMC43IDg2LjYgMTA1LjRjLTEyLjUtMTIuNS0zMi44LTEyLjUtNDUuMyAwcy0xMi41IDMyLjggMCA0NS4zTDE0Ni43IDI1NiA0MS40IDM2MS40Yy0xMi41IDEyLjUtMTIuNSAzMi44IDAgNDUuM3MzMi44IDEyLjUgNDUuMyAwTDE5MiAzMDEuMyAyOTcuNCA0MDYuNmMxMi41IDEyLjUgMzIuOCAxMi41IDQ1LjMgMHMxMi41LTMyLjggMC00NS4zTDIzNy4zIDI1NiAzNDIuNiAxNTAuNnoiLz48L3N2Zz4=");
    background-position: center;
    background-repeat: no-repeat;
    -webkit-transition: .4s;
    transition: .4s;
}

.switch input:checked+.slider {
    background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMTYiIHdpZHRoPSIxNCIgdmlld0JveD0iMCAwIDQ0OCA1MTIiPjwhLS0hRm9udCBBd2Vzb21lIEZyZWUgNi41LjEgYnkgQGZvbnRhd2Vzb21lIC0gaHR0cHM6Ly9mb250YXdlc29tZS5jb20gTGljZW5zZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tL2xpY2Vuc2UvZnJlZSBDb3B5cmlnaHQgMjAyMyBGb250aWNvbnMsIEluYy4tLT48cGF0aCBvcGFjaXR5PSIxIiBmaWxsPSIjNjhlMTQ3IiBkPSJNNDM4LjYgMTA1LjRjMTIuNSAxMi41IDEyLjUgMzIuOCAwIDQ1LjNsLTI1NiAyNTZjLTEyLjUgMTIuNS0zMi44IDEyLjUtNDUuMyAwbC0xMjgtMTI4Yy0xMi41LTEyLjUtMTIuNS0zMi44IDAtNDUuM3MzMi44LTEyLjUgNDUuMyAwTDE2MCAzMzguNyAzOTMuNCAxMDUuNGMxMi41LTEyLjUgMzIuOC0xMi41IDQ1LjMgMHoiLz48L3N2Zz4=");
}

/* .switch .active {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    -webkit-transition: .4s;
    transition: .4s;
}

.switch input:checked+.active+.activated {
    display: none;
}

.switch input:checked+.active+.non_activated {
    display: none;
}

.switch input:not(:checked)+.active+.activated {
    display: none;
} */
</style>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <input type="text" class="form-control border-0" id="searchTable" placeholder="Tìm kiếm ...">
        <div class="d-flex">
            <!-- <div class="importExcel me-3">
                <input type="file" name="importExcel" id="importExcel"
                    accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" hidden>
                <label for="importExcel">
                    <img class="icons-list" src="<?=base_url('public/images/default/add-employees.png') ?>"
                        alt="Import Employee" />
                </label>
            </div> -->
            <div class="dropdown">
                <img class="icons-list" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false"
                    src="<?=base_url('public/images/default/filter.png') ?>" alt="Import Employee" />
                <div class="dropdown-menu" style="min-width: 250px; padding: 20px 5px">


                    <div class="mb-3">
                        <label class="form-label fw-bold">Nhóm</label>
                        <select class="form-select" id="gr" style="width: 100%;" multiple>
                            <?php if(isset($part)) foreach($part as $p){
                                echo '<option>' . $p . '</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="applyEmp">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle" id="listPermissions"
                style="min-width: 1000px; max-height: calc(100vh - 100px);">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" class="text-center align-middle">No.</th>
                        <th rowspan="2" class="text-center align-middle">Nhân viên</th>
                        <th rowspan="2" class="text-center align-middle">Kích hoạt tài khoản</th>
                        <?php
                            if(isset($GroupAndPermission)) foreach ($GroupAndPermission as $key => $value) {
                                if($value['permission'] != null)
                                    echo '<th colspan="'. strval(count((array)$value['permission'])) .'" class="text-center align-middle">'. $value['title'] .'</th>';
                                }
                        ?>
                        <th rowspan="2" class="text-center align-middle">Action</th>
                    </tr>
                    <tr>
                        <?php
                            //$columns = ['user_active'];
                            if(isset($GroupAndPermission)) foreach ($GroupAndPermission as $key => $value) {
                                if($value['permission'] != null)
                                    foreach ($value['permission'] as $k => $val) {
                                        echo '<th>'. $val['title'] .'</th>';
                                        $columns[] = $key.'.'.$k;
                                    }
                            }
                        ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- <?= var_dump($GroupAndPermission);?> -->

<script src="<?= base_url('public/vendor/datatables/js/datatables.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/select2/js/select2.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript">
columns = JSON.parse('<?php echo json_encode($columns); ?>');

columnss = [{
        data: 'no'
    },
    {
        data: 'name_and_id'
    }, {
        data: 'user_active',
        className: 'dt-center',
        width: '150px',
        render: function(data, type, row) {
            if (data == '0')
                return `<span class="text-danger needActive">Chưa kích hoạt</div>`;
            else if (data == '1')
                return `<span class="text-success">Đã kích hoạt</div>`;
            else '';
        }
    }
]
columns.forEach(element => {
    columnss.push({
        data: element.replace('.', ''),
        width: '50px',
        className: 'dt-center',
        render: function(data, type, row) {
            return `<label class="switch" for="${row.id_employee + '_' + element}">
                        <input type="checkbox" id="${row.id_employee + '_' + element}" ${(data == '1' ? 'checked' : '')}>
                        <span class="slider"></span>
                    </label>`;
        }
    })
});
columnss.push({
    width: '50px',
    className: 'dt-center',
    data: 'action'
})

var listPermissions = $('#listPermissions').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '<?= base_url('permission/postListEmp') ?>',
        method: 'POST',
        data: function(d) {
            d.searchTable = $('#searchTable').val();
            /*  d.filterPart = $('#gr').val().length !== 0 ? $('#gr').val() : $("#gr option").map(function() {
                return $(this).val()
            }).get(); */
        }
    },
    order: [],
    columnDefs: [{
        targets: [0, 1, -1],
        orderable: false
    }],
    columns: columnss,
    scrollX: true,
});
//sư kiện kích hoạt trên bảng quyền
listPermissions.on('click', 'tbody tr td:last-child li[ac="active"]', function() {
    Swal.fire({
        icon: "question",
        html: `Bạn có muốn <b>${$(this).text()}</b> tài khoản này?`,
        showConfirmButton: true,
        showCancelButton: true
    }).then(async result => {
        id = $(this).parent().parent().parent().find('span').html();
        id_key = $(this).parent().parent().parent().find('.needActive').length;
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('permission/action/active') ?>?id=' + id +
                '&id_key=' + id_key;
        }
    });
});
//sự kiện lấy lại mật khẩu trên bảng quyền
listPermissions.on('click', 'tbody tr td:last-child li[ac="resetpassword"]', function() {
    Swal.fire({
        icon: "question",
        html: `Bạn có muốn <b>${$(this).text()}</b> tài khoản này?`,
        showConfirmButton: true,
        showCancelButton: true
    }).then(async result => {
        id = $(this).parent().parent().parent().find('span').html();
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('permission/action/resetpassword') ?>?id=' + id;
        }
    });
});
//sư kiện thay đổi quyền trên bảng quyền
listPermissions.on('click', 'tbody tr td:last-child li[ac="updatepermission"]', function() {
    Swal.fire({
        icon: "question",
        html: `Bạn có muốn <b>${$(this).text()}</b> tài khoản này?`,
        showConfirmButton: true,
        showCancelButton: true
    }).then(async result => {
        let postData = new FormData();
        postData.append('id', $(this).parent().parent().parent().find('span').html());
        $(this).parent().parent().parent().find('input').each(function() {
            postData.append($(this).attr('id').split('_')[1], $(this).is(":checked"));
        });
        //console.log(baseUrl);
        if (result.isConfirmed) {
            var kq = await getFetch('<?= base_url('permission/action/updatepermission') ?>',
                postData);
            Swal.fire({
                icon: kq.status,
                text: kq.msg
            });
            listPermissions.ajax.reload();
        }
    });
});

$('#listPermissions_wrapper .row:eq(0)').css('opacity', '0').css('height', '0px');
</script>