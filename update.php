<?php
$xml = simplexml_load_file("students.xml");
$id = $_POST['id'];

foreach ($xml->student as $s) {
    if ((string)$s->id === $id) {
        $s->name = $_POST['name'];
        $s->course = $_POST['course'];
        $s->year_level = $_POST['year_level'];
        $s->section = $_POST['section'];
        $s->adviser = $_POST['adviser'];
        $s->school_year = $_POST['school_year'];

        if (!empty($_FILES["profile_picture"]["name"])) {
            $uploadDir = "uploads/";
            $filename = basename($_FILES["profile_picture"]["name"]);
            $uploadFile = $uploadDir . $filename;
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadFile);
            $s->profile_picture = $uploadFile;
        }

        break;
    }
}

$xml->asXML("students.xml");
header("Location: manage.php");
?>
