<?php
$date = date_create_from_format("d/m/Y", "22/11/2017");
echo $date->format("d/m/Y") . "\n";
$date->add(new \DateInterval('P15D'));
echo $date->format("d/m/Y") . "\n";