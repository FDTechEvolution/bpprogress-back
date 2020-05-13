/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function setTopViewProduct() {
    $.get(siteurl + 'sv-products/get-top-view-product', {})
            .done(function (data) {
                console.log(data);
                $.each(data.data, function (index, product) {
                    let html = '';
                    html += '<tr>';
                    html += '<td><img src="' + product.image + '" alt="' + product.name + '" width="40"></td>';
                    html += '<td>' + product.name + '</td>';
                    html += '<td class="text-right">' + Number(product.view_count).toLocaleString('en') + '</td>';
                    html += '</tr>';
                    $('#tb-topview tbody').append(html);
                });

            });
}

function setTopSalesProduct() {
    $.get(siteurl + 'sv-products/get-top-sales', {})
            .done(function (data) {
                console.log(data);
                $.each(data.data, function (index, product) {
                    let html = '';
                    html += '<tr>';
                    html += '<td><img src="' + product.image + '" alt="' + product.name + '" width="40"></td>';
                    html += '<td>' + product.name + '</td>';

                    html += '<td class="text-right">' + Number(product.salesamt).toLocaleString('en') + '</td>';
                    html += '</tr>';
                    $('#tb-topsales tbody').append(html);
                });

            });
}

$(document).ready(function () {
    //tb-topview
    setTopViewProduct();
    setTopSalesProduct();

    $('[data-action="refresh-tb"]').on('click', function () {
        let data_id = $(this).attr('data-id');
        $('#' + data_id + ' tbody').empty();

        if (data_id === 'tb-topsales') {
            setTopSalesProduct();
        } else if (data_id === 'tb-topview') {
            setTopViewProduct();
        }

    });
});