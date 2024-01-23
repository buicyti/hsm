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

.personal {
    margin-bottom: 20px;
}

.personal i {
    font-size: 24px;
}

.views-personal {
    margin-left: 10px;
}

.views-personal strong {
    color: var(--color);
    font-size: 14px;
    margin-bottom: 0;
}

.views-personal span {
    color: var(--color);
    font-size: 12.5px;
    font-weight: 500;
    margin-bottom: 0;
}
</style>


<?php include_once('app\Views\includes\breadcrumb.php') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <input type="text" class="form-control border-0" id="searchTable" placeholder="Tìm kiếm ...">
        <div class="d-flex">
            <div class="importExcel me-3">
                <input type="file" name="importExcel" id="importExcel"
                    accept=" application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" hidden>
                <label for="importExcel">
                    <img class="icons-list" src="<?=base_url('public/images/default/add-employees.png') ?>"
                        alt="Import Employee" />
                </label>
            </div>
            <div class="dropdown">
                <img class="icons-list" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false"
                    src="<?=base_url('public/images/default/filter.png') ?>" alt="Import Employee" />
                <div class="dropdown-menu" style="min-width: 250px; padding: 20px 5px">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Xưởng</label>
                        <select class="form-select" id="factory" style="width: 100%;" multiple>
                            <option value="SMD 1">SMD 1</option>
                            <option value="SMD 2">SMD 2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nhóm</label>
                        <select class="form-select" id="gr" style="width: 100%;" multiple>
                            <?php if(isset($part)) foreach($part as $p){
                                echo '<option>' . $p . '</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Bậc lương</label>
                        <select class="form-select" id="rk" style="width: 100%;" multiple>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Ca</label>
                        <select class="form-select" id="sf" style="width: 100%;" multiple>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Trạng thái</label>
                        <select class="form-select" id="stt" style="width: 100%;" multiple>
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
            <table class="table table-striped table-bordered align-middle" id="listEmployees"
                style="min-width: 1000px; width: 100%; max-height: calc(100vh - 100px);">
                <thead class="text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nhân viên</th>
                        <th>Nhóm</th>
                        <th>Ca</th>
                        <th>Chức danh</th>
                        <th>Công việc</th>
                        <th>Cấp bậc</th>
                        <th>Sinh nhật</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



<!-- Modal Show befor Add -->
<div class="modal fade" id="addEmployee" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Thêm nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered align-middle" id="showAddEmployees"
                    style="height: 1000px; width: 50%; overflow: scroll;">
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addEmpCf">Import All</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Infomation -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body row">
                <div class="col-12 col-md-5">
                    <div class="card m-2">
                        <div class="card-body">
                            <div class="d-flex flex-column text-center">
                                <img src="<?= base_url('public/images/default/default-user-icon.png') ?>"
                                    class="img-thumbnail rounded-circle mb-3" alt="hihi" />
                                <strong class="fs-4 pb-3">Alex Ferguson</strong>
                                <span class="fs-6 pb-3 text-secondary">1040001</span>
                                <span class="fw-bold fs-6">Admin</span>
                            </div>
                            <div class="d-flex justify-content-center flex-row mt-3">
                                <button class="btn btn-outline-primary btn-sm me-2">Tin nhắn</button>
                                <button class="btn btn-outline-success btn-sm">Sửa</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="card m-2">
                        <div class="card-body m-2">
                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-user"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Tên nhân viên</strong>
                                    <span>Alex Ferguson</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-key"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Mã nhân viên</strong>
                                    <span>1040001</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-compass"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Khối</strong>
                                    <span>G-Class</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-compass"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Bậc lương</strong>
                                    <span>Manager 10</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-shuttle-space"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Chức vụ</strong>
                                    <span>Admin</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-user-doctor"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Công việc</strong>
                                    <span>3D-5S</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-user-doctor"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Ngày vào</strong>
                                    <span>01/01/2014</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-user-group"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Xưởng</strong>
                                    <span>SMD</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-user-group"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Nhóm</strong>
                                    <span>3M</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-poop"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Ca làm việc</strong>
                                    <span>Hành chính</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-phone"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Số điện thoại</strong>
                                    <span>Cá nhân: 0123456789</span>
                                    <span>Người thân: 0123456789</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-headset"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Trình độ</strong>
                                    <span>Cấp: Mầm non</span>
                                    <span>Trường: Mẫu giáo lớn</span>
                                    <span>Chuyên ngành: None</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-address-card"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Hộ khẩu thường trú</strong>
                                    <span>Yen Binh IZ, Pho Yen, Thai Nguyen</span>
                                </div>
                            </div>

                            <div class="personal d-flex flex-row align-items-center">
                                <i class="fa-solid fa-car-side"></i>
                                <div class="views-personal d-flex flex-column">
                                    <strong>Đăng ký tạm trú</strong>
                                    <span> Yen Binh IZ, Pho Yen, Thai Nguyen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>








<script src="<?= base_url('public/vendor/datatables/js/datatables.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/select2/js/select2.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>

<script type="text/javascript">
$('#rk, #factory, #gr, #sf, #stt').select2({
    placeholder: 'Chọn tất cả',
    closeOnSelect: false,
})

listEmployees = $('#listEmployees').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '<?= base_url('all/employees/query') ?>',
        method: 'POST',
        data: function(d) {
            d.searchTable = $('#searchTable').val();
            d.filterPart = $('#gr').val().length !== 0 ? $('#gr').val() : $("#gr option").map(function() {
                return $(this).val()
            }).get();
        }
    },
    columns: [{
        data: 'id_no'
    }, {
        data: 'name_and_id'
    }, {
        data: 'part'
    }, {
        data: 'shift'
    }, {
        data: 'title'
    }, {
        data: 'job'
    }, {
        data: 'rank',

    }, {
        data: 'birthday',
        render: function(data, type, row) {
            return moment(row.birthday).format('DD/MM/YYYY')
        }
    }, {
        data: 'action'
    }],
    scrollX: true,
});

$('#searchTable').change(function(event) {
    listEmployees.ajax.reload();
});

listEmployees.on('click', 'tbody tr td:not(:last-child)', function() {
    const empMd = $('#employeeModal .modal-dialog .modal-content .modal-body');
    var d = listEmployees.row($(this).parents()).data();
    $('.col-12.col-md-5 img', empMd).attr('src', d.avatar_url)
    $('.col-12.col-md-5 img', empMd).attr('alt', d.name_employee)
    $('.col-12.col-md-5 strong', empMd).html(d.name_employee)
    $('.col-12.col-md-5 span:eq(0)', empMd).html(d.id_employee)
    $('.col-12.col-md-5 span:eq(1)', empMd).html(d.title == '0' ? 'Member' : d.title)



    $('.col-12.col-md-7 span:eq(0)', empMd).html(d.name_employee)
    $('.col-12.col-md-7 span:eq(1)', empMd).html(d.id_employee)
    $('.col-12.col-md-7 span:eq(2)', empMd).html(d.class)
    $('.col-12.col-md-7 span:eq(3)', empMd).html(d.rank + ' ' + d.rank_no)
    $('.col-12.col-md-7 span:eq(4)', empMd).html(d.title == '0' ? 'Member' : d.title)
    $('.col-12.col-md-7 span:eq(5)', empMd).html(d.job)
    $('.col-12.col-md-7 span:eq(6)', empMd).html(moment(d.join_date).format('DD/MM/YYYY'))
    $('.col-12.col-md-7 span:eq(7)', empMd).html((d.factory == '0' ? 'SMD' : (d.factory == '1' ?
        'SMD1' : (d.factory == '2' ? 'SMD2' : 'Err'))))
    $('.col-12.col-md-7 span:eq(8)', empMd).html(d.part)
    $('.col-12.col-md-7 span:eq(9)', empMd).html(d.shift)
    $('.col-12.col-md-7 span:eq(10)', empMd).html('Cá nhân: ' + d.phone1)
    $('.col-12.col-md-7 span:eq(11)', empMd).html('Người thân: ' + d.phone2)
    /* $('.col-12.col-md-7 span:eq(10)', empMd).html(d.)
    $('.col-12.col-md-7 span:eq(11)', empMd).html(d.)
    $('.col-12.col-md-7 span:eq(12)', empMd).html(d.) */
    $('.col-12.col-md-7 span:eq(15)', empMd).html(d.residence.replaceAll('|', ' - '))
    $('.col-12.col-md-7 span:eq(16)', empMd).html(d.temporary_residence.replaceAll('|', ' - '))

    $('#employeeModal').modal('show')
});
//nút lọc
$('#applyEmp').on('click', function() {
    listEmployees.ajax.reload(null, false);
    $('.dropdown img.icons-list').trigger('click');
});

//ẩn thanh tìm kiếm của bảng
$('#listEmployees_wrapper .row:eq(0)').css('opacity', '0').css('height', '1px')
</script>