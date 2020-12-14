<?php

namespace Anax\View;

?>

<h1>DI</h1>
<p>Länk till mitt <a href="./di-api">API</a></p>
<form method="POST">
    <label><b>IP</b></label><br>
    <input type="text" name="ipPost"><br>
    <input type="submit" value="Check" name="ipCheck">
</form><br>
<form method="POST">
    <label><b>Koordinater</b></label><br>
    <label>Längdgrad -180 <-> 180</label><br>
    <input type="number" name="lonPost" min="-180" max="180" step="0.0001"><br>
    <label>Breddgrad -90 <-> 90</label><br>
    <input type="number" name="latPost" min="-90" max="90" step="0.0001"><br>
    <input type="submit" value="Check" name="coCheck">
</form>

<?php if ($error) : ?>
    <p><b><?= $error ?></b></p>
<?php endif; ?>

<?php if ($history) : ?>
    <p>
        <b>
        Plats: <?= $history[0]["timezone"] ?> <br>
        <?php if ($city && $country) : ?>
        Stad: <?= $city ?> <br>
        Land: <?= $country ?> <br>
        <?php endif; ?>
        Lattitud: <?= $lat ?> <br> 
        Longditud: <?= $lon ?>
        </b>
    </p>
<?php endif; ?>

<?php if ($history) : ?>
    <h3><b>Historik</b></h3>
    <table class="tabell" style="text-align: center;">
    <tr>
        <th>Datum</th>
        <th>Temperatur °C</th>
        <th>Väder</th>
        <th>Vindhastighet m/s</th>
    </tr>
    <?php for ($i=0; $i < 5; $i++) : ?>
    <tr>
        <td><?= date("Y-m-d", $history[$i]["hourly"][17]["dt"]) ?></td>
        <td><?= $history[$i]["hourly"][17]["temp"] ?></td>
        <td><?= $history[$i]["hourly"][17]["weather"][0]["description"] ?></td>
        <td><?= $history[$i]["hourly"][17]["wind_speed"] ?></td>
    </tr>
    <?php endfor ?>
</table>
<?php endif; ?>

<?php if ($forecast) : ?>
    <h3><b>Prognos</b></h3>
    <table class="tabell" style="text-align: center;">
    <tr>
        <th>Datum</th>
        <th>Temperatur °C</th>
        <th>Väder</th>
        <th>Vindhastighet m/s</th>
    </tr>
    <?php for ($i=1; $i < 6; $i++) : ?>
    <tr>
        <td><?= date("Y-m-d", $forecast[0]["daily"][$i]["dt"]) ?></td>
        <td><?= $forecast[0]["daily"][$i]["temp"]["day"] ?></td>
        <td><?= $forecast[0]["daily"][$i]["weather"][0]["description"] ?></td>
        <td><?= $forecast[0]["daily"][$i]["wind_speed"] ?></td>
    </tr>
    <?php endfor ?>
</table>
<?php endif; ?>

<?php if ($map) : ?>
    <p><b><?= $map ?></b></p>
<?php endif; ?>

