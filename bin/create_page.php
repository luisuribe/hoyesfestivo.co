<?php 
$db      = new SQLite3('./holidays');
$now     = new DateTime(date('Y-m-d'));
$results = $db->query("SELECT * FROM holidays WHERE holiday_date >= '".$now->format('Y-m-d')."' LIMIT 1");
$row     = $results->fetchArray();

$holiday_date = new DateTime($row['holiday_date']);

if ( $now->format('Y-m-d') == $holiday_date->format('Y-m-d') ) {
    copy('../templates/holiday.html', '../index.html');
} else {
    $difference = $now->diff($holiday_date);

    $note = "Faltan <strong>X</strong> d&iacute;as para el pr&oacute;ximo festivo (HOLYDAY)";
    $note = preg_replace('/HOLYDAY/', $row['holiday_date'] , $note);
    $note = preg_replace('/X/', $difference->days , $note);

    $template = file_get_contents('../templates/not_holiday.html');
    $new_file = preg_replace('/NOTE/', $note , $template);
    $fp       = fopen('../index.html', 'w+');
    fwrite($fp, $new_file);
    fclose($fp);
}
