 $("#green").hide();
 $("#red").hide();
 $(document).ready(function () {
     var randomNumberkey = Math.floor(Math.random() * 10000000000);
     $.post("captcha.php", {
         key: randomNumberkey
     }, function (result) {
         var imgsource = "image" + randomNumberkey + ".png";
         console.log(result);
         $("#captchawindow").attr('src', imgsource); //retreive the generated image to display
     });
 });
 $("#textform").click(function (event) {
     event.preventDefault(); //prevent page reload on submit
 });

 function auth() { //start authentication by sending the text entered
     var txt = $("#inputcaptcha").val();
     if (txt.length == 0) {
         alert("The textbox is empty!");
     }
     else {
         $.post("captcha.php", {
             target: txt
         }, function (result) {
             if (result == 1) {
                 $("#red").show(); //alert if not successful
                 setTimeout(updater, 3000);
             }
             else if (result == 0) {
                 $("#green").show(); //alert if successful
                 setTimeout(updater, 3000);
             }
         });
     }
 }

 $('.close').click(function (event) {
     $(this).parent().hide();
 })

 function updater() {
     location.reload();
 }