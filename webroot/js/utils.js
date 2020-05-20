/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function generateCode(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function removeElementById(id) {
    $("#" + id).remove();
}

function numberOnly(ele) {
    $(ele).keypress(function (e) {
        var strNumber = this.value;
         if(strNumber==='0'){
             this.value ='';
         }
//if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error message
            //alert("Insert Only Numbers");
            return false;
        }
       
        
    });
}