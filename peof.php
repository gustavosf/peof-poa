<?php

$db = new PDO('sqlite:peof.sqlite');
$locations = $db->query('select * from locations')->fetchAll(PDO::FETCH_OBJ);
echo json_encode($locations);