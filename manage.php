<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Student Management System</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background: url('bggg.png') no-repeat center center / cover;
      padding: 40px 20px;
      color: #ffffff;
      min-height: 100vh;
    }

    .top-nav {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 12px 24px;
    }

    .nav-button {
      text-decoration: none;
      color: white;
      font-weight: bold;
      margin-left: 20px;
      padding: 8px 16px;
      border-radius: 8px;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .nav-button:hover {
      background-color: #00c9ff;
      text-decoration: underline;
    }

    .section {
      display: none;
    }

    .section.active {
      display: block;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: white;
    }

    .add-button {
      display: right;
      margin: 20px 20px 20px auto;
      background: linear-gradient(135deg, #00c9ff, #92fe9d);
      color: #000;
      border: none;
      padding: 12px 30px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .add-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0, 255, 255, 0.3);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(8px);
      border-radius: 12px;
      color: #fff;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.1);
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    th {
      background-color: rgba(0, 0, 0, 0.8);
    }

    td img {
      width: 60px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
    }

    .actions a {
      padding: 6px 12px;
      margin-right: 5px;
      background: linear-gradient(to right, #00c9ff, #92fe9d);
      color: #000;
      text-decoration: none;
      border-radius: 6px;
      font-size: 13px;
      font-weight: bold;
    }

    .actions a:hover {
      opacity: 0.8;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(3px);
    }

    .modal-content {
      background: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 16px;
      max-width: 500px;
      margin: 80px auto;
      color: #fff;
      position: relative;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
      backdrop-filter: blur(10px);
    }

    .close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
      color: #ff4d4d;
    }

    .modal form input,
    .modal form button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 10px;
      font-size: 14px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
    }

    .modal form input::placeholder {
      color: #ccc;
    }

    .modal form button {
      background: linear-gradient(135deg, #00c9ff, #92fe9d);
      color: #000;
      font-weight: bold;
      cursor: pointer;
    }

    .modal form select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 10px;
      font-size: 14px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20fill='%23ffffff'%20height='24'%20viewBox='0%200%2024%2024'%20width='24'%20xmlns='http://www.w3.org/2000/svg'%3E%3Cpath%20d='M7%2010l5%205%205-5z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 16px;
    }

    .modal form select option {
      background-color: #000;
      color: #fff;
    }

    .modal form button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.4);
    }

    .edit-scrollable {
      max-height: 90vh;
      overflow-y: auto;
      width: 90%;
      max-width: 500px;
      margin: 50px auto;
      padding: 20px 30px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      text-align: center;
      padding: 40px 20px;
    }

    .profiles {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 40px;
      margin-top: 40px;
    }

    .profile-card {
      background: rgba(0, 0, 0, 0.6);
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
      padding: 30px;
      width: 300px;
      color: #ffffff;
      backdrop-filter: blur(10px);
    }

    .profile-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
      border: 4px solid #00c9ff;
    }

    .profile-info {
      font-size: 16px;
      line-height: 1.6;
    }

    .description {
      margin-top: 50px;
      background: rgba(0, 0, 0, 0.6);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
      font-size: 16px;
      line-height: 1.8;
      text-align: justify;
    }

    #deleteModal button {
      width: 100%;
      margin: 10px 0;
      padding: 10px;
      border-radius: 8px;
      border: none;
      font-weight: bold;
      cursor: pointer;
    }

    #deleteModal button:hover {
      opacity: 0.9;
    }

    #deleteModal button[type="button"] {
      background: #ccc;
      color: #000;
    }

    .search-bar {
      padding: 12px 20px;
      width: 40%;
      border-radius: 10px;
      background-color: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(5px);
      border: none;
      color: #fff;
      font-size: 16px;
      outline: none;
      transition: 0.3s ease;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
    }

    .search-bar::placeholder {
      color: white;
    }

    .search-bar:focus {
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.4);
    }
  </style>
</head>
<body>

<div class="top-nav">
  <span class="nav-button" onclick="showSection('student')">Student List</span>
  <span class="nav-button" onclick="showSection('about')">About Us</span>
  <a href="auth.php" class="nav-button">Log Out</a>
</div>

<div id="student" class="section active">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;"><input type="text" id="searchInput" class="search-bar" placeholder="Search students...">
    <button class="add-button" onclick="document.getElementById('addModal').style.display='block'">Add Student</button>
  </div>

  <table>
    <thead>
    <tr>
      <th>Profile</th>
      <th>Name</th>
      <th>Program</th>
      <th>Year/Section</th>
      <th>Adviser</th>
      <th>School Year</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $xml = simplexml_load_file("students.xml") or die("Failed to load XML.");
    foreach ($xml->student as $student) {
        echo "<tr>";
        echo "<td><img src='{$student->profile_picture}' alt='Profile'></td>";
        echo "<td>{$student->name}</td>";
        echo "<td>{$student->course}</td>";
        echo "<td>{$student->year_level} {$student->section}</td>";
        echo "<td>{$student->adviser}</td>";
        echo "<td>{$student->school_year}</td>";
        echo "<td class='actions'>
        <a href='#' class='edit-btn' 
        data-id='{$student->id}'
        data-name='{$student->name}'
        data-picture='{$student->profile_picture}'
        data-course='{$student->course}'
        data-year='{$student->year_level}'
        data-section='{$student->section}'
        data-adviser='{$student->adviser}'
        data-sy='{$student->school_year}'>Edit</a>
        <a href='#' class='delete-btn' onclick='openDeleteModal({$student->id}); return false;'>Delete</a>
        </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
  </table>
</div>

<div id="about" class="section">
  <div class="container">
    <h1>Meet The Developers</h1>
    <div class="profiles">
      <div class="profile-card">
        <img src="MICHAEL.png" alt="Michael Josh S. Tropicales">
        <div class="profile-info">
          <p><strong>Name:</strong> Michael Josh S. Tropicales</p>
          <p><strong>Program:</strong> BSIT Major in Business Analytics</p>
          <p><strong>Year & Section:</strong> 3B - G1</p>
          <p><strong>Role:</strong> Front-End Developer</p>
        </div>
      </div>
      <div class="profile-card">
        <img src="david.png" alt="David I. Alvarez">
        <div class="profile-info">
          <p><strong>Name:</strong> David I. Alvarez</p>
          <p><strong>Program:</strong> BSIT Major in Business Analytics</p>
          <p><strong>Year & Section:</strong> 3B - G1</p>
          <p><strong>Role:</strong> Back-End Developer</p>
        </div>
      </div>
    </div>
    <div class="description">
      <p>
        We are third-year BSIT students from section B Group 1, passionate about technology and business analytics. This Student Management System was created as part of our academic requirements to demonstrate our skills in handling data using XML, enhancing user interfaces, and organizing student information in a functional and accessible way.
      </p>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="document.getElementById('addModal').style.display='none'">&times;</span>
    <h2>Add Student</h2>
    <form action="create.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Full Name" required>
  <input type="file" name="profile_picture" accept="image/*" required>

  <select name="course" required>
    <option value="" disabled selected>Select Program</option>
    <option value="BSIT">BSIT</option>
    <option value="BLIS">BLIS</option>
    <option value="BSIS">BSIS</option>
  </select>

  <select name="year_level" required>
    <option value="" disabled selected>Select Year Level</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>

  <input type="text" name="section" placeholder="Section" required>
  <input type="text" name="adviser" placeholder="Adviser" required>
  <input type="text" name="school_year" placeholder="School Year" required>
  <button type="submit">Add Student</button>
</form>
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
  <div class="modal-content edit-scrollable">
    <span class="close" onclick="document.getElementById('editModal').style.display='none'">&times;</span>
    <h2>Edit Student</h2>
    <form action="update.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" id="edit-id">
      <input type="text" name="name" id="edit-name" required>
      <img id="edit-preview" src="" width="100" height="100"><br>
      <label>Change Picture:</label>
      <input type="file" name="profile_picture" accept="image/*"><br>
      <input type="text" name="course" id="edit-course" required>
      
      <select name="year_level" id="edit-year" required>
        <option value="" disabled>Select Year Level</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
      
      <input type="text" name="section" id="edit-section" required>
      <input type="text" name="adviser" id="edit-adviser" required>
      <input type="text" name="school_year" id="edit-sy" required>
      <button type="submit">Save</button>
    </form>
  </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeDeleteModal()">&times;</span>
    <h2>Confirm Deletion</h2>
    <p>Are you sure you want to delete this student?</p>
    <form id="deleteForm" method="GET" action="delete.php">
      <input type="hidden" name="id" id="delete-id">
      <button type="submit" style="background: linear-gradient(to right, #ff4d4d, #ff9999); color: #000;">Yes, Delete</button>
      <button type="button" onclick="closeDeleteModal()">Cancel</button>
    </form>
  </div>
</div>

<script>
  function openDeleteModal(id) {
    document.getElementById('delete-id').value = id;
    document.getElementById('deleteModal').style.display = 'block';
  }

  function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
  }

  function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
  }

  window.onclick = function(e) {
    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    if (e.target == addModal) addModal.style.display = "none";
    if (e.target == editModal) editModal.style.display = "none";
    if (e.target == deleteModal) deleteModal.style.display = "none";  
  }

  document.getElementById('searchInput').addEventListener('keyup', function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll('#student table tbody tr');

  rows.forEach(row => {
    const cells = Array.from(row.getElementsByTagName('td'));
    const text = cells.map(cell => cell.textContent.toLowerCase()).join(' ');
    row.style.display = text.includes(filter) ? '' : 'none';
  });
});

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', function () {
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-name').value = this.dataset.name;
        document.getElementById('edit-preview').src = this.dataset.picture;
        document.getElementById('edit-course').value = this.dataset.course;
        document.getElementById('edit-year').value = this.dataset.year;
        document.getElementById('edit-section').value = this.dataset.section;
        document.getElementById('edit-adviser').value = this.dataset.adviser;
        document.getElementById('edit-sy').value = this.dataset.sy;
        document.getElementById('editModal').style.display = 'block';
      });
    });
  });
</script>

</body>
</html>
