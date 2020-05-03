/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    //<span class="badge badge-danger badge-pill float-right" id="notis-new-order">0</span><span> รายการสั่งซื้อ
   
    $.get(siteurl + 'sv-notifications/count-new-order', {})
            .done(function (data) {
                $('#notis-new-order').text(data.data);
            });
});