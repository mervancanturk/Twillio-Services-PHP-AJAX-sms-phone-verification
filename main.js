$(document).ready(function(){
    $("#enter_number").submit(function(e) {
        e.preventDefault();
        if(check_number()){
        initiateSms();
    }
    });
    $("#verify_code").submit(function(e) {
        e.preventDefault();
        if($("#verification_code").val().length > 5){
            initiateCode();
            $("#code_wrong").fadeOut();
        }else{
            $("#code_wrong").fadeIn();
        }
        
    });
});

function initiateSms() {

$.ajax({
    type: "POST",
    url: "start_verify.php",
    data: { phone_number: iti.getNumber(intlTelInputUtils.numberFormat.E164) },
    dataType: "json",
    success: function(data) {
        console.log(data);
        if(data != false){
        showVerifyForm();
        $("#sms_sid").val(data);
    }else{
        alert("Wrong phone number!");
    }
    }
});
};

function initiateCode() {

$.ajax({
    type: "POST",
    url: "send_code.php",
    data: { phone_number: iti.getNumber(intlTelInputUtils.numberFormat.E164),posted_code : $("#verification_code").val() },
    dataType: "json",
    success: function(data) {
        if(data == "approved"){
            //if you want to save this phone number, you can do in here.
            $("#verify_code").fadeOut("fast");
            $("#verify_done").fadeIn();
        }else{
            $("#code_wrong").fadeIn();
        }
    }
});

};

function showVerifyForm() {
    $("#phone_number2").val($("#phone").val());
    $("#enter_number").fadeOut("fast");
    $("#verify_code").fadeIn();
}