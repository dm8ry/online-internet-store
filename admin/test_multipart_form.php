<HTML>
<HEAD>Test Multipart</HEAD>
<BODY>
<H1>The Form</H1>

<script>

function sendForm() {
  var oOutput = document.getElementById("output");
  var oData = new FormData(document.forms.namedItem("fileinfo"));

  oData.append("CustomField", "This is some extra data");

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "check_multipart.php", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      oOutput.innerHTML = oReq.responseText;
    } else {
      oOutput.innerHTML = "Error " + oReq.status + " occurred uploading your file.<br \/>";
    }
  };

  oReq.send(oData);
}

</script>

<form enctype="multipart/form-data" method="post" name="fileinfo">
  <label>Your email address:</label>
  <input type="email" autocomplete="on" autofocus name="userid" placeholder="email" required size="32" maxlength="64" /><br />
  <label>Custom file label:</label>
  <input type="text" name="filelabel" size="12" maxlength="32" /><br />
  <label>File to stash:</label>
  <input type="file" name="file" required />
</form>
<div id="output"></div>
<a href="javascript:sendForm()">Stash the file!</a>

</BODY>
</HTML>