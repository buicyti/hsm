<?= view('includes/header.php') ?>
<style>
main {
    padding-top: 0;
}

.my-tabs {
    position: relative;
}

.Calligraffitti {
    font-weight: 700;
    text-shadow: -1px 1px 20px #ced0d3;
    color: #F9f1cc;
    text-shadow: 0px 0px 0px #FFB650,
        1px 1px 0px #FFD662,
        3px 3px 0px #FF80BF,
        5px 5px 0px #EF5097,
        7px 7px 0px #6868AC,
        9px 9px 0px #90B1E0;
}



.my-tabs .tabs-menu input {
    display: none;
}

.my-tabs .tabs-menu label {
    padding: 0 20px;
    font-size: 13px;
    line-height: 49px;
    margin: 0 5px 5px 0;
    border-radius: 5px;
    background: #fff;
    box-shadow: 0 2px rgba(0, 0, 0, 0.2);
    color: #808080;
    opacity: 0.8;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.1s;
    -o-transition: all 0.1s;
    -ms-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -webkit-transition: all 0.1s;
}

.my-tabs .tabs-menu input:checked+label {
    position: relative;
    background: #fff;
    margin-bottom: 0;
    padding-bottom: 5px;
    border: 1px solid var(--border-color);
    box-shadow: 0 0;
    /* border-bottom-right-radius: 0;
    border-bottom-left-radius: 0; */
    cursor: default;
    color: #2b82d9;
    opacity: 1;
}

.my-tabs .tabs-menu input:checked+label::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    right: 0;
    width: 100%;
    height: 10px;
    background: #fff;
    z-index: 100;
}

.my-tabs .tab-contents {
    width: 100%;
    height: 600px;
    background: #fff;
    position: relative;
    padding: 20px;
    border: 1px solid var(--border-color);
    border-radius: 5px;
    box-shadow: 0 3px rgba(0, 0, 0, 0.2);
    overflow: auto;
    z-index: 99;
}

.my-tabs .tab-contents .tab-pane {
    width: 700px;
    position: absolute;
    top: 20px;
    left: 20px;
    transform: scale(0.1, 0.1);
    opacity: 0;
    transition: all 0.5s;
}

.my-tabs .tab-contents .tab-pane.show {
    transform: scale(1, 1);
    opacity: 1;
}




.my-tabs>.tab-contents .row {
    border: 1px solid var(--border-color);
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
}

.my-tabs>.tab-contents .row>img {
    width: 96px;
}



@media screen and (max-width: 800px) {
    .my-tabs .tabs-menu label {
        width: 100%;
    }

    .my-tabs .tabs-menu input:checked+label {
        margin-bottom: 5px;
        padding-bottom: 0px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .my-tabs .tabs-menu input:checked+label::after {
        width: 0;
        height: 0;
    }
}
</style>








<!-- <header class="fixed-top">
</header> -->
<main>
    <div class="main-wrapper d-flex justify-content-center align-items-center">
        <div class="container-sm" style="max-width: 800px">
            <h1 class="Calligraffitti">SMD DEPARTMENT</h1>
            <!-- tabs -->

            <div class="my-tabs">
                <div class="tabs-menu">
                    <input type="radio" name="pcss3t" checked id="allPart">
                    <label for="allPart"><i class="fa-solid fa-hat-cowboy-side"></i>TẤT CẢ</label>

                    <input type="radio" name="pcss3t" id="tab2">
                    <label for="tab2"><i class="icon-picture"></i>THIẾT bỊ</label>

                    <input type="radio" name="pcss3t" id="tab3">
                    <label for="tab3"><i class="icon-cogs"></i>CHẤT LƯỢNG</label>

                    <input type="radio" name="pcss3t" id="tab4">
                    <label for="tab4"><i class="icon-globe"></i>SẢN XUẤT</label>

                    <!-- <input type="radio" name="pcss3t" id="tab5">
                    <label for="tab5"><i class="icon-globe"></i>SẢN XUẤT</label>

                    <input type="radio" name="pcss3t" id="tab6">
                    <label for="tab6"><i class="icon-globe"></i>SẢN XUẤT</label>

                    <input type="radio" name="pcss3t" id="tab7">
                    <label for="tab7"><i class="icon-globe"></i>SẢN XUẤT</label>

                    <input type="radio" name="pcss3t" id="tab8">
                    <label for="tab8"><i class="icon-globe"></i>SẢN XUẤT</label> -->
                </div>
                <div class="tab-contents">
                    <div class="tab-pane show" tabs-label="allPart">

                        <a href="<?= base_url('all/employees') ?>" class="row">
                            <img class="col-auto" src="<?=  base_url('public/images/default/staff.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">Thông tin nhân viên</h6>
                                <p>Quản lý thông tin nhân lực của bộ phận</p>
                            </div>
                        </a>
                        <a href="<?= base_url('all/esd') ?>" class="row">
                            <img class="col-auto"
                                src="<?=  base_url('public/images/default/durability-deterioration.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">ESD - Đo tĩnh điện</h6>
                                <p>Quản lý lịch sử đo tĩnh điện của bộ phận</p>
                            </div>
                        </a>


                    </div>




                    <div class="tab-pane" tabs-label="tab2">

                        <div class="row">
                            <img class="col-auto" src="<?=  base_url('public/images/default/staff.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">faf fefsaf àdasd</h6>
                                <p>Diển dải</p>
                            </div>
                        </div>
                        <div class="row">
                            <img class="col-auto"
                                src="<?=  base_url('public/images/default/durability-deterioration.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">asdas adasd adfasdf</h6>
                                <p>Diển dải</p>
                            </div>
                        </div>
                        <div class="row">
                            <img class="col-auto" src="<?=  base_url('public/images/default/staff.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">faf fefsaf àdasd</h6>
                                <p>Diển dải</p>
                            </div>
                        </div>
                        <div class="row">
                            <img class="col-auto"
                                src="<?=  base_url('public/images/default/durability-deterioration.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">asdas adasd adfasdf</h6>
                                <p>Diển dải</p>
                            </div>
                        </div>
                        <div class="row">
                            <img class="col-auto" src="<?=  base_url('public/images/default/staff.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">faf fefsaf àdasd</h6>
                                <p>Diển dải</p>
                            </div>
                        </div>
                        <div class="row">
                            <img class="col-auto"
                                src="<?=  base_url('public/images/default/durability-deterioration.png');?>" alt="" />
                            <div class="col-auto">
                                <h6 class="fw-bold">asdas adasd adfasdf</h6>
                                <p>Diển dải</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>




        <?= view('includes/footer.php') ?>


        <script type="text/javascript">
        var content = `<a href="<?= base_url('/auth/signout') ?>">Đăng xuất</a>`;
        $('footer').append(content);

        $('input[type=radio][name="pcss3t"]').change(function() {
            //console.log($(this).attr('id'))
            $('.tab-contents .tab-pane').removeClass('show');
            $(`.tab-contents .tab-pane[tabs-label="${$(this).attr('id')}"]`).addClass('show');
        });
        </script>