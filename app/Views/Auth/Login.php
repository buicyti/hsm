<?= view('includes/header.php') ?>



<style>
ul.reg-check {
    list-style: none;
    position: relative;
}

ul.reg-check li.text-success::before {
    content: '\f00c';
    font-family: 'Font Awesome 6 Free';
    font-weight: 600;
    position: absolute;
    left: 0px;
    font-size: 10px;
}

ul.reg-check li.text-danger::before {
    content: '\f00d';
    font-family: 'Font Awesome 6 Free';
    font-weight: 600;
    position: absolute;
    left: 0px;
    font-size: 10px;
}
</style>



<div class="container">
    <div class="vh-100 d-flex justify-content-between align-items-center">
        <div class="row lockscreen">
            <div class="lock-image col-12 col-md-6"></div>
            <div class="login-form col-12 col-md-6 p-3">
                <h3 class="fw-bold mb-3">Login</h3>

                <label for="username">Username</label>
                <div class="form-group mb-3">
                    <input class="form-control" type="text" name="username" id="username" placeholder="Tên tài khoản"
                        autocomplete="on" required>
                </div>

                <label for="password">Password</label>
                <div class="form-group password mb-3">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Mật khẩu"
                        required>
                    <i class="fa-solid fa-eye"></i>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="checkboxsignin" id="checkboxsignin"
                        checked="true">
                    <label class="form-check-label" for="checkboxsignin">Ghi nhớ mật khẩu</label>
                </div>

                <div class="form-group mb-0">
                    <button class="btn btn-primary" type="button" id="login"> Đăng nhập </button>
                </div>

                <div class="notification text-danger mt-3">

                </div>




                <p class="my-2 text-muted">--- Or connect with ---</p>
                <a class="btn btn-social btn-dropbox text-white mb-2">
                    <i class="icon-social-dropbox align-middle"></i>
                </a>
                <a class="btn btn-social btn-facebook text-white mb-2">
                    <i class="icon-social-facebook align-middle"></i>
                </a>
                <a class="btn btn-social btn-github text-white mb-2">
                    <i class="icon-social-github align-middle"></i>
                </a>
                <a class="btn btn-social btn-google text-white mb-2">
                    <i class="icon-social-google align-middle"></i>
                </a>
                <div class="mt-2">Bạn không có tài khoản? <a href="/auth/register">Tạo tài khoản mới</a></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$('#login').click(async () => {
    var postData = new FormData();
    postData.append('username', $('#username').val());
    postData.append('password', $('#password').val());
    var data = await getFetch('<?= base_url('auth/signin/loginSubmit') ?>', postData);

    if (data.error) {
        $('.notification').html(data.message)
    } else {
        $('.notification').html('<div class="text-success">Đăng nhập thành công</div>')
        window.location.href = '<?= base_url(); ?>'
    }
})
</script>



<script type="text/javascript" src="<?= base_url('public/javascripts/script.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>