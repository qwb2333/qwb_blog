$(document).ready(function() {
    $("#button_ok").click(function(){
        var pass = $("#pass").val();
        if(pass.length == 0) {
            alert("密码错误");
        }
        else {
            $.post("ajax_admin.php",{pass: pass}, function(res){
                var obj = JSON.parse(res);
                if(!obj.success) {
                    alert(obj.message);
                }
                else{
                    location.href = "index.php";
                }
            });
        }
    });
});