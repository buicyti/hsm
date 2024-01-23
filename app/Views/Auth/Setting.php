<div class="row">
    <div class="col-sm-8 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-bold">Đổi mật khẩu</h6>
            </div>
            <form action="<?= base_url('auth/setting/changepassword')?>" method="POST" class="card-body">
                <div class="mb-2 row">
                    <label for="password_old" class="col-sm-6 col-lg-4 col-form-label">Mật khẩu cũ</label>
                    <div class="col-sm-12 col-lg-8 form-group password">
                        <input class="form-control" type="password" name="password_old" id="password_old"
                            placeholder="Nhập mật khẩu cũ" required>
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="password_new" class="col-sm-6 col-lg-4 col-form-label">Mật khẩu mới</label>
                    <div class="col-sm-12 col-lg-8 form-group password">
                        <input class="form-control" type="password" name="password_new" id="password_new"
                            placeholder="Nhập mật khẩu mới" required>
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="password_re_new" class="col-sm-6 col-lg-4 col-form-label">Nhập lại mật khẩu mới</label>
                    <div class="col-sm-12 col-lg-8 form-group password">
                        <input class="form-control" type="password" name="password_re_new" id="password_re_new"
                            placeholder="Nhập lại mật khẩu mới" required>
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Đổi</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>