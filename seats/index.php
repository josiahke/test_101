
<?php
$str = file_get_contents('seats.json');
$json = json_decode($str, true);
//print_r($json);
//exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Bus - seats </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="seats.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

</head>
<body>

<div class="bus">
    <div class="front">
        <h1>Please select a seat</h1>
    </div>
    <div class="exit exit--front fuselage">

    </div>

    <hr>
    <strong> Front Seats</strong>
    <hr>

    <ol class="cabin fuselage">
        <li class="row row--1">
                <?php
                $front_seats = $json['front_seats']['seats'][1];
                $c = count($front_seats);
                $i = 0;
                for( $ii=0; $ii<$c; $ii++){
                    $i++;
                    if($i % 4 == 1)echo "<ol class=\"seats\" type=\"A\">";
                    echo "<li class=\"seat\">";
                    //print_r( $words[$ii]);
                    echo '<input type="checkbox" id="'.$front_seats[$ii]['id'].'" '.($front_seats[$ii]['booked'] == 1 ? 'disabled' : null).' /> ';
                    echo '<label for="'.$front_seats[$ii]['id'].'">'.$front_seats[$ii]['title'].'</label>';
                    echo "</li>";
                    if($i % 4 == 0)echo "</ol>";
                }
                ?>
        </li>
    </ol>

    <hr>
        <strong> Other Seats</strong>
    <hr>

    <?php
    foreach($json['other_seats']['seats'] as $ky => $list ) {
    ?>

    <li class="row row--<?=$ky+1?>">
<!--        <ol class="seats" type="A">-->
            <?php
            $other_seats = $list;//$json['other_seats']['seats'][1];
            $c = count($other_seats);
            $i = 0;
            echo "<ol class=\"seats\" type=\"A\">";
            for( $ii=0; $ii<$c; $ii++){
                $i++;
                echo "<li class=\"seat\">";
                echo '<input type="checkbox" id="'.$other_seats[$ii]['id'].'" '.($other_seats[$ii]['booked'] == 1 ? 'disabled' : null).' /> ';
                echo '<label for="'.$other_seats[$ii]['id'].'">'.$other_seats[$ii]['title'].'</label>';
                echo "</li>";
            }
            echo "</ol>";
            ?>
<!--        </ol>-->
    </li>

    <?php } ?>

    <div class="exit exit--back fuselage">

    </div>

</div>

</body>
</html>
