<!-- START: Header-->
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg p-0">
        <!-- Logo -->
        <a href="<?= base_url();?>" class="d-flex justify-content-center align-items-center logo-bar text-left">
            <img src="<?= base_url('public/images/default/logo_for_light.svg') ?>" alt="Hansol" class="full-logo">
            <img src="<?= base_url('public/images/default/default-small.svg') ?>" alt="Hansol" class="small-logo">
        </a>

        <!-- Toogle button -->
        <div class="text-center align-self-center collapse-menu-bar">
            <i class="fa-solid fa-align-justify"></i>
        </div>
        <!-- Sidebar -->
        <ul class="sidebar-menu">
            <?php if(isset($nav)) foreach($nav as &$menu){ ?>

            <li <?= isset($menu['children']) ? ' class="dropdown"' : '' ?>>
                <a href="<?= isset($menu['url']) ? base_url($menu['url']) : current_url(); ?>">
                    <i class="<?=$menu['icon']; ?>"></i>
                    <?=$menu['name']; ?>
                </a>
                <?php if(isset($menu['children'])){ ?>
                <ul>
                    <!-- nếu có thẻ con -->
                    <?php  foreach($menu['children'] as &$sub_menu){ ?>
                    <li <?= isset($sub_menu['children']) ? ' class="dropdown"' : '' ?>>
                        <!-- hiện link -->
                        <a href="<?= isset($sub_menu['url']) ? base_url($sub_menu['url']) : current_url(); ?>">
                            <i class="<?= $sub_menu['icon'] ?>"></i>
                            <?= $sub_menu['name'] ?>
                        </a>

                        <!-- nếu có thẻ con trong thẻ con thì gom -->
                        <?php if(isset($sub_menu['children'])){ ?>
                        <ul class="sub-menu">
                            <?php  foreach($sub_menu['children'] as &$sub_sub_menu){ ?>
                            <li>
                                <a href="<?= base_url($sub_sub_menu['url']) ?>">
                                    <i class="<?= $sub_sub_menu['icon'] ?>"></i>
                                    <?= $sub_sub_menu['name'] ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>

                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </li>

            <?php } ?>
        </ul>




        <div class="end-sidebar"></div>
        <!-- User -->
        <ul class="user-profile">
            <li class="dropdown align-self-center d-inline-block">
                <div class="media nav-link" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= (isset($info) && isset($info['avatar'])) ? $info['avatar'] : base_url('/public/images/default/default-user-icon.png') ?>"
                        onerror="this.src='<?= base_url('/public/images/default/default-user-icon.png')?>'" alt=""
                        class="d-flex img-fluid rounded-circle" />
                    <div class="user-text">
                        <h6>
                            <?= (isset($info) && isset($info['name_employee'])) ? $info['name_employee'] : 'Alex Ferguson' ?>
                        </h6>
                        <p class="text-muted mb-0">
                            <?= (isset($info) && isset($info['job'])) ? $info['job'] : 'Nhân viên' ?>
                        </p>
                    </div>
                </div>


                <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="dropdownUser">
                    <a href="<?= base_url('all/employees/infomation/') . (isset($info) && isset($info['id_employee'])) ? $info['id_employee'] : '4' ?>"
                        class="dropdown-item p-2">
                        <i class="fa-regular fa-user"></i>
                        Thông tin cá nhân
                    </a>
                    <a href="<?= base_url('auth/setting')?>" class="dropdown-item px-2">
                        <i class="fa-solid fa-gears"></i>
                        Cài đặt
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item p-2">
                        <i class="fa-solid fa-circle-half-stroke"></i>
                        <input type="checkbox" id="changeTheme" style="display: none;">
                        <label for="changeTheme"> Giao diện</label>
                    </a>
                    <a href="" class="dropdown-item p-2">
                        <i class="fa-brands fa-rocketchat"></i>
                        Chat
                    </a>
                    <a href="" class="dropdown-item p-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Liên hệ hỗ trợ
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('/auth/signout') ?>"
                        class="dropdown-item p-2 text-danger d-flex justify-content-between">
                        <span><i class="fa-solid fa-power-off"></i> Sign Out</span>
                        <i class="fa-solid fa-right-from-bracket me-1"></i>
                    </a>
                </div>

            </li>

        </ul>


    </nav>
</header>
<!-- END: Header-->

<main>
    <div class="main-wrapper">