<?php

namespace Anax\View;

?>

<h1>DI-API</h1>
<p>
    Man kommer åt datan med IP eller lat och lon. <br>
    Formaten som gäller är /di-api/jsonDI?ip=[ip] eller /di-api/jsonDI?lat=[lat]&lon=[lon] <br>
    Där lon -180 - 180 och lat -90 - 90

</p>
<p>En felaktig länk</p>
<a href="./di-api/jsonDI?ip=hej">/di-api/jsonDI?ip=hej</a><br>
<p>En länk med ip</p>
<a href="./di-api/jsonDI?ip=8.8.8.8">/di-api/jsonDI?ip=8.8.8.8</a><br>
<p>Felaktiga koordinater</p>
<a href="./di-api/jsonDI?lat=700&lon=500">/di-api/jsonDI?lat=700&lon=500</a><br>
<p>En länk med lat och lon</p>
<a href="./di-api/jsonDI?lat=45&lon=45">/di-api/jsonDI?lat=45&lon=45</a><br><br>
<form method="POST" action="./di-api/jsonDI">
    <label><b>IP</b></label><br>
    <input type="text" name="ipPost"><br>
    <input type="submit" value="Check" name="ipCheck">
</form><br>
<form method="POST" action="./di-api/jsonDI">
    <label><b>Koordinater</b></label><br>
    <label>Längdgrad -180 <-> 180</label><br>
    <input type="number" name="lonPost" min="-180" max="180" step="0.0001"><br>
    <label>Breddgrad -90 <-> 90</label><br>
    <input type="number" name="latPost" min="-90" max="90" step="0.0001"><br>
    <input type="submit" value="Check" name="coCheck">
</form>