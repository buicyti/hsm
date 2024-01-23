//loader
$(window).on('load', () => {
    $('.se-pre-con').fadeOut("slow")
})

//show/hide sidebar
$('.collapse-menu-bar, .end-sidebar').on('click', () => {
    $('.sidebar-menu').toggleClass('active');
    $('.end-sidebar').toggleClass('show');

});
//sự kiện click để mở sidebar ở chế độ tab
$('.sidebar-menu .dropdown>a').on('click', function() {
    if ($(window).width() < 992) {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active'); //nếu đang mở thì đóng lại
        } else {
            $('li.dropdown', $(this).parents('ul.sidebar-menu')).removeClass('active'); // bỏ class active ul đang mở
            $(this).parent().addClass('active');
        }

        return false;
    }
});

//ẩn hiện mật khẩu
$('.password i').on('click', function() {
    if ($(this).hasClass('fa-eye')) {
        $(this).parent().find('input').attr('type', 'text')
        $(this).removeClass('fa-eye fa-eye-slash').addClass('fa-eye-slash')
    } else {
        $(this).parent().find('input').attr('type', 'password')
        $(this).removeClass('fa-eye fa-eye-slash').addClass('fa-eye')
    }
})

const getFetch = (link, jsonData) => fetch(link, {
    method: 'POST',
    mode: 'no-cors',
    headers: {
        'Content-Type': 'application/json',
        "X-Requested-With": "XMLHttpRequest"
    },
    body: jsonData
}).then(res => {
    if (res.ok) return res.json();
    return res;
}).catch(err => {
    return err;
})