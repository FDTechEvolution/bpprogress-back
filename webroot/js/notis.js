/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function success(msg) {
    //$.NotificationApp.send("Well Done!", msg, "top-right", "#5ba035", "success");
    $.toast({
        heading: 'เรียบร้อย',
        text: msg,
        showHideTransition: 'slide',
        icon: 'success',
        position:'top-right',
        
    });
}

function error(msg) {
    $.NotificationApp.send("Oh snap!", msg, "top-right", "#bf441d", "error");
}