<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    if ($_POST) {
        date_default_timezone_set('Europe/Brussels'); // Is er echt geen andere manier dan deze hele blok hier boven <title> te moeten plaatsen om het te kunnen veranderen?
        $timezone = date_default_timezone_get();

        $currentTime = time();
        $currentHours = date("H", $currentTime);
        $currentMinutes = date("i", $currentTime);

        $simulatedHours = $currentHours + $_POST['hours'];
        $simulatedHours = ($simulatedHours >= 24) ? $simulatedHours - 24 : $simulatedHours;

        $title = '';
        $bodyStyle = '';
        $message = '';

        if ($simulatedHours >= 6 and $simulatedHours < 10) {
            $title = 'Goedemorgen!';
            $bodyStyle = 'color: black; background-color: lightgray;';
        }
        elseif ($simulatedHours >=10 and $simulatedHours < 22) {
            $title = 'Hallo!';
            $bodyStyle = 'color: black; background-color: white;';
        }
        else {
            $title = 'Goedenavond!';
            $bodyStyle = 'color: white; background-color: black;';
        }
    }
    ?>
    <title><?=isset($title) ? $title : 'Tijd simulatie'?></title>
    <style>
        body {
            <?= $bodyStyle ?>
        }
    </style>
</head>
<body>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <label for="hours">Simulate server time +</label>
        <select onchange="this.form.submit()" name="hours" id="hours">
            <?php
                for ($i = 1; $i <= 24; $i++) {
                    echo "<option value='{$i}'>{$i}</option>";
                }
            ?>
        </select>
    </form>
    <?=date('H:i', $currentTime)?>
    <div id="result">
        <?php
            echo "<h2>$title Het is nu {$simulatedHours}:{$currentMinutes} (server tijdzone: $timezone)</h2>"
        ?>
    </div>
</body>
</html>