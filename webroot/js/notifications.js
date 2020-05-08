/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    //<span class="badge badge-danger badge-pill float-right" id="notis-new-order">0</span><span> รายการสั่งซื้อ

    $.get(siteurl + 'sv-notifications/get-order-by-status', {})
            .done(function (data) {
                console.log(data);
                $.each(data.data, function (index, item) {
                    if(item.status ==='NEW'){
                        $('#notis-new-order').text(item.amt);
                    }
                });
                
            });
});