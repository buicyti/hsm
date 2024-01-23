<!-- START: Breadcrumbs-->
<div class="row ">
    <div class="col-12 align-self-center">
        <div class="py-3 align-self-center d-flex">
            <h4 class="mb-0"><?= isset($title) ? $title : 'Title' ?></h4>
            <ol class="ms-auto breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item"><?= isset($breadcrumb) ? $breadcrumb[0] : '1' ?></li>
                <li class="breadcrumb-item"><?= isset($breadcrumb) ? $breadcrumb[1] : '2' ?></li>
                <li class="breadcrumb-item active"><?= isset($breadcrumb) ? $breadcrumb[2] : '3' ?></li>
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->