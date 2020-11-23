<?php

namespace Anax\View;

?>

<h1>IP-API</h1>
<p>
    För att testa en ip med /GET, lägg till "/jsonIp?ip=[ip-adress]" efter url:en
</p>
<p><b>/GET</b></p>
<p>Här är några testroutes med olika ip</p>
<a href="./ip-api/jsonIp?ip=8.8.8.8">/ip-api/jsonIp?ip=8.8.8.8</a><br>
<a href="./ip-api/jsonIp?ip=0000:0000:0000:0000:0000:0000:0000:0001">
    /ip-api/jsonIp?ip=0000:0000:0000:0000:0000:0000:0000:0001
</a><br>
<a href="./ip-api/jsonIp?ip=123.4.56.789">/ip-api/jsonIp?ip=123.4.56.789</a><br><br>
<p><b>/POST</b></p>
<p>Ett formulär för att testa en ip</p>
<p>Postas till "/ip-api/jsonIp"</p>
<form method="POST" action="./ip-api/jsonIp">
    <input type="text" name="ipPost">
    <input type="submit" value="Validate" name="validate">
</form>
