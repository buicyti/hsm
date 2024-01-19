<style>
.background-image-maker {
    position: absolute;
    height: 100%;
    top: 0;
    left: 0;
    width: 100%;
    background-size: cover;
    background-position: center;
    background-color: transparent;
    background-image: url('<?= base_url('/public/images/default/portfolio13.jpg') ?>');
}


.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    background-color: var(--bs-secondary);
}

.theme-background {
    background-color: var(--headerbackground);
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
<div class="col-12 mt-3">
    <div class="position-relative">
        <div class="background-image-maker py-5"></div>
        <div class="position-relative px-3 py-5">
            <div class="media d-md-flex d-block">
                <img src="<?= base_url() ?>public/images/avatars/<?= (isset($employees) && isset($employees['id_employee'])) ? $employees['id_employee'] : '0';?>.jpg"
                    alt="<?= (isset($employees) && isset($employees['name_employee'])) ? $employees['name_employee'] : 'Alex Ferguson';?>"
                    class="img-fluid rounded-circle" style="width: 150px; aspect-ratio: 1/1;" />

                <div class="ps-4 d-flex flex-column justify-content-center">
                    <h1 class="display-4 text-uppercase text-white mb-0">
                        <?= (isset($employees) && isset($employees['name_employee'])) ? $employees['name_employee'] : 'Alex Ferguson';?>
                    </h1>
                    <h6 class="text-uppercase text-white mb-0">
                        <?= (isset($employees) && isset($employees['title'])) ? ($employees['title'] != '0' ? $employees['title'] : 'Nhân viên') : 'Nhân viên';?>
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class=""> -->
    <div class="mt-2 theme-background border p-2 d-flex justify-content-between">

        <div class="align-self-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($mode) && $mode == "infomation") ? 'active' : ''?>"
                        href="<?= base_url('all/employees/infomation/') . (isset($id) ? $id : '') ?>">
                        Thông tin cá nhân
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($mode) && $mode == "edit") ? 'active' : ''?>"
                        href="<?= base_url('all/employees/edit/') . (isset($id) ? $id : '') ?>">
                        Chỉnh sửa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($mode) && $mode == "history") ? 'active' : ''?>"
                        href="<?= base_url('all/employees/history/') . (isset($id) ? $id : '') ?>">
                        Lịch sử
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($mode) && $mode == "permission") ? 'active' : ''?>"
                        href="<?= base_url('all/employees/permission/') . (isset($id) ? $id : '') ?>">
                        Quyền truy cập
                    </a>
                </li>
            </ul>
        </div>

        <div class="align-self-center">
            <a href="#">
                <i class="fa-brands fa-dropbox"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-github"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-google"></i>
            </a>
        </div>
    </div>

</div>