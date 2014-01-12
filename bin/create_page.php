<?php 
$db = new SQLite3('./holidays');
$now = date('Y-m-d');
$results = $db->query("SELECT * FROM holidays WHERE holiday_date >= '".$now."' LIMIT 1");
$row = $results->fetchArray();

if ( $now == $row['holiday_date'] ) {
    copy('../templates/holiday.html', '../index.html');
} else {
    $template = file_get_contents('../templates/not_holiday.html');
    $new_file = preg_replace('/HOLYDAY/', $row['holiday_date'], $template);
    $fp = fopen('../index.html', 'w+');
    fwrite($fp, $new_file);
    fclose($fp);
}
?>