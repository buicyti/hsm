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
('<?=(session() ->getFlashdata('msg')); ?>' != '' ? true : false) && Swal.fire({
    type: "error",
    title: "Lỗiiiiiii !",
    text: '<?= session()->getFlashdata('msg') ?>',
    confirmButtonClass: "btn btn-sm btn-error"
});
</script>
</body>

</html>