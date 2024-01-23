</div>
<footer>2023 © Engineer team</footer>
<div class="se-pre-con">
    <div class="loader"></div>
</div>
</main>




<script src="<?= base_url('public/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/javascripts/script.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script>
var msg_success = `<?=(session() ->getFlashdata('msg_success')); ?>`;
var msg_error = `<?=(session() ->getFlashdata('msg_error')); ?>`;
msg_success.length && Swal.fire({
    icon: "success",
    title: "Thành công!",
    html: msg_success
});
msg_error.length && Swal.fire({
    icon: "error",
    title: "Lỗi!",
    html: msg_error
});
</script>
</body>

</html>