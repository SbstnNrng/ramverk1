<?php

namespace Seb\Ip;

?>

<h1>IP-Validator</h1>
<p>Länk till mitt <a href="./ip-api">API</a></p>
<p>Mata in en IP-adress för att se om den validerar </p>
<form method="POST">
    <input type="text" name="ipPost">
    <input type="submit" value="Validate" name="validate">
</form>
<?php if ($ip && $domain) : ?>
    <p><b><?= $ip ?></b></p>
    <p><b><?= $domain ?></b></p>
<?php endif; ?>
