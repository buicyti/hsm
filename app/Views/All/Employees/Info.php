<?php include_once('app\Views\includes\breadcrumb.php') ?>

<!-- START: Card Data-->
<div class="row">

    <?php include_once('head.php') ?>



    <div class="col-12 mt-3">
        <div class="card p-3">
            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-user"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Tên nhân viên</strong>
                    <span>
                        <?= (isset($employees) && isset($employees['name_employee'])) ? $employees['name_employee'] : 'Alex Ferguson';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-key"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Mã nhân viên</strong>
                    <span><?= (isset($employees) && isset($employees['id_employee'])) ? $employees['id_employee'] : '4';?></span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-compass"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Khối</strong>
                    <span><?= (isset($employees) && isset($employees['class'])) ? $employees['class'] : 'O-Class';?></span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-compass"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Bậc lương</strong>
                    <span>
                        <?= (isset($employees) && isset($employees['rank'])) ? $employees['rank'] . ' ' . $employees['rank_no'] : '0';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-shuttle-space"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Chức vụ</strong>
                    <span>
                        <?= (isset($employees) && isset($employees['title'])) ? $employees['title'] : 'Nhân viên';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-user-doctor"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Công việc</strong>
                    <span>
                        <?= (isset($employees) && isset($employees['job'])) ? $employees['job'] : '3D-5S';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-user-doctor"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Ngày vào</strong>
                    <span>
                        <?= (isset($employees) && isset($employees['join_date'])) ? $employees['join_date'] : '01/01/2014';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-user-group"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Xưởng</strong>
                    <span>
                        SMD <?= (isset($employees) && isset($employees['factory'])) ? $employees['factory'] : '';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-user-group"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Nhóm</strong>
                    <span>
                        <?= (isset($employees) && isset($employees['part'])) ? $employees['part'] : '3M';?>
                    </span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-poop"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Ca làm việc</strong>
                    <span><?= (isset($employees) && isset($employees['shift'])) ? $employees['shift'] : 'Hành chính';?></span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-phone"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Số điện thoại</strong>
                    <span>Cá nhân:
                        <?= (isset($employees) && isset($employees['phone1'])) ? str_pad($employees['phone1'], 10, '0', STR_PAD_LEFT) : '0';?></span>
                    <span>Người thân:
                        <?= (isset($employees) && isset($employees['phone2'])) ? str_pad($employees['phone2'], 10, '0', STR_PAD_LEFT) : '0';?></span>
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
                    <span><?= (isset($employees) && isset($employees['residence'])) ? str_replace('|', ' - ', $employees['residence']) : 'Yen Binh IZ, Pho Yen, Thai Nguyen'?></span>
                </div>
            </div>

            <div class="personal d-flex flex-row align-items-center">
                <i class="fa-solid fa-car-side"></i>
                <div class="views-personal d-flex flex-column">
                    <strong>Đăng ký tạm trú</strong>
                    <span><?= (isset($employees) && isset($employees['temporary_residence'])) ? str_replace('|', ' - ', $employees['temporary_residence']) : 'Yen Binh IZ, Pho Yen, Thai Nguyen'?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END: Card DATA-->