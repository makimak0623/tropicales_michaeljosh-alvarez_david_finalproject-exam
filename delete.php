<?php
$xml = simplexml_load_file("students.xml");
$id = $_GET['id'];

$index = 0;
foreach ($xml->student as $student) {
    if ((string)$student->id === $id) {
        if (file_exists((string)$student->profile_picture)) {
            unlink((string)$student->profile_picture);
        }

        unset($xml->student[$index]);
        break;
    }
    $index++;
}

$xml->asXML("students.xml");
header("Location: manage.php");
?>
