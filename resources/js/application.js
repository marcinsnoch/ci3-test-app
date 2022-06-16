const baseUrl = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '');
const url = window.location;

$('ul.nav-sidebar a').filter(function () {
    return this.href == url;
}).addClass('active');

$('ul.nav-treeview a').filter(function () {
    return this.href == url;
}).parents().eq(2).addClass('menu-open');

$(function () {
    const $accountIdDropDown = $('#accountIdDropDown');
    $accountIdDropDown.on('change', function(e){
        $.ajax({
            url: baseUrl + '/accounts/ajax_set',
            type: 'post',
            data: {
                'account_id': $accountIdDropDown.val()
            },
            success: function (dataResult) {
                console.log(dataResult);
                window.location.reload(true);
            }
        });
    });
});
