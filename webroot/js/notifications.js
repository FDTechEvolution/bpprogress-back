/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    //<span class="badge badge-danger badge-pill float-right" id="notis-new-order">0</span><span> รายการสั่งซื้อ

    $.get(siteurl + 'sv-notifications/get-order-by-status', {})
            .done(function (data) {
                // console.log(data);
                $.each(data.data, function (index, item) {
                    var html = '<span class="badge badge-pill badge-light-dark">' + item.amt + '</span>';
                    if (item.status === 'NEW') {
                        $('#notis-new-order').text(item.amt);
                        $('#notis-bt-new-order').append(html);
                    } else if (item.status === 'WT') {
                        $('#notis-bt-wt-order').append(html);
                    } else if (item.status === 'SENT') {
                        $('#notis-bt-sent-order').append(html);
                    } else if (item.status === 'RECEIVED') {
                        $('#notis-bt-received-order').append(html);
                    }
                });

            });

    $.get(siteurl + 'sv-notifications/get-preorder-by-status', {})
            .done(function (data) {
                // console.log(data);
                $.each(data.data, function (index, item) {
                    var html = '<span class="badge badge-pill badge-light-dark">' + item.amt + '</span>';
                    if (item.status === 'NEW') {
                        $('#notis-new-preorder').text(item.amt);
                        $('#notis-bt-new-preorder').append(html);
                    } else if (item.status === 'WT') {
                        $('#notis-bt-wt-preorder').append(html);
                    } else if (item.status === 'SENT') {
                        $('#notis-bt-sent-preorder').append(html);
                    } else if (item.status === 'RECEIVED') {
                        $('#notis-bt-received-preorder').append(html);
                    }
                });

            });

    $.get(siteurl + 'sv-notifications/get-payment-by-status', {})
            .done(function (data) {
                // console.log(data);
                $.each(data.data, function (index, item) {
                    var html = '<span class="badge badge-pill badge-light-dark">' + item.amt + '</span>';
                    if (item.status === 'NEW') {
                        $('#notis-new-payment').text(item.amt);
                        $('#notis-bt-new-payment').append(html);
                    }else if (item.status === 'CF') {
                        $('#notis-bt-cf-payment').append(html);
                    }
                });

            });
});