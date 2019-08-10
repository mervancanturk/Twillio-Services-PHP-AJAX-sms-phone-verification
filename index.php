<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>International Phone Verification via SMS by Twilio</title>
  <link rel="stylesheet" href="static/css/intlTelInput.css">
  <link rel="stylesheet" href="static/css/demo.css">
</head>

<body>
  <div class="centercontent">
  <h1>International Phone Verification via SMS by Twilio</h1>
  <form id="enter_number">
    <input id="phone" name="phone" type="tel">
    <button type="submit">Submit</button>
    <br /><br />
    <span id="valid-msg" class="hide">✓ Valid</span>
    <span id="error-msg" class="hide"></span>
  </form>
  <input type="hidden" id="sms_sid">


	
	<form id="verify_code" style="display: none;">
		<p>Sending you a text message with your verification code.</p>
		<p>Once received, enter it here:</p>
        <p id="code_wrong" style="display: none;">Code is wrong. Please Try Again.</p>
		<h1 ><input id="verification_code" type="number" name="verification_code" required /></h1>

		<p><input type="submit" value="Verify" /></p>
	</form>

    <div id="verify_done" style="display: none;">
    <h3>Phone Verification is done. Thanks.</h3>
    </div>

</div>

  <script src="static/js/intlTelInput.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-3.1.0.min.js"></script>
  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      dropdownContainer: document.body,
      placeholderNumberType: "MOBILE",
      //separateDialCode: true,
      utilsScript: "static/js/utils.js",
    });
  
  var input = document.querySelector("#phone"),
  errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");

var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

var iti = window.intlTelInput(input, {
  utilsScript: "../../build/js/utils.js"
});

var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

function check_number(){
    reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
      input.classList.add("valid");
      return true;
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
      return false;
    }
  }
}
// on blur: validate
input.addEventListener('blur', function() {
    check_number()
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
</script>
<script type="text/javascript" src="main.js"> </script>

</body>

</html>
