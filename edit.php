<?php
$id = $_GET['id'];
$xml = simplexml_load_file("students.xml");
$student = null;

foreach ($xml->student as $s) {
    if ((string)$s->id === $id) {
        $student = $s;
        break;
    }
}

if ($student):
?>
<form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $student->id ?>">
    <input type="text" name="name" value="<?= $student->name ?>" required><br>
    <img src="<?= $student->profile_picture ?>" width="100" height="100"><br>
    <label>Change Picture:</label>
    <input type="file" name="profile_picture" accept="image/*"><br>
    <input type="text" name="course" value="<?= $student->course ?>" required><br>
    <input type="text" name="year_level" value="<?= $student->year_level ?>" required><br>
    <input type="text" name="section" value="<?= $student->section ?>" required><br>
    <input type="text" name="adviser" value="<?= $student->adviser ?>" required><br>
    <input type="text" name="school_year" value="<?= $student->school_year ?>" required><br>
    <button type="submit">Update</button>
</form>
<?php else: ?>
    <p>Student not found.</p>
<?php endif; ?>
