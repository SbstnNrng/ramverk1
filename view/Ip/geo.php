<?php

namespace Anax\View;

?>

<h1>IP-Geo</h1>
<p>Länk för att få geografisk position för ip via api <a href="./ip-geo-api">geo-api</a></p>
<p>Mata in en IP-adress för att få dess geografiska position</p>
<form method="POST">
    <input type="text" name="ipPost" value="<?= $userIp ?>">
    <input type="submit" value="Check" name="validate">
</form>
<?php if ($ip && $location && $cords) : ?>
    <p><b><?= $ip ?></b></p>
    <p><b><?= $location ?></b></p>
    <p><b><?= $cords ?></b></p>
<?php endif; ?>