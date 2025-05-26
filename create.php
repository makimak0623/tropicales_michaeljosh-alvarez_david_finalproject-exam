<?php
$xml = simplexml_load_file("students.xml") or die("Failed to load XML.");
$id = count($xml->student) > 0 ? (int)$xml->student[count($xml->student)-1]->id + 1 : 1;

$uploadDir = "uploads/";
$filename = basename($_FILES["profile_picture"]["name"]);
$uploadFile = $uploadDir . $filename;
move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadFile);

$name = $_POST['name'];
$course = $_POST['course'];
$year_level = $_POST['year_level'];
$section = $_POST['section'];
$adviser = $_POST['adviser'];
$school_year = $_POST['school_year'];

$newStudent = $xml->addChild("student");
$newStudent->addChild("id", $id);
$newStudent->addChild("name", $name);
$newStudent->addChild("profile_picture", $uploadFile);
$newStudent->addChild("course", $course);
$newStudent->addChild("year_level", $year_level);
$newStudent->addChild("section", $section);
$newStudent->addChild("adviser", $adviser);
$newStudent->addChild("school_year", $school_year);

$xml->asXML("students.xml");
header("Location: manage.php");
?>
