<?php
require "header.php";
require "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skillsString = $_POST["skills"];

        if (!$name || !validateEmail($email) || empty($skillsString)) {
            throw new Exception("Invalid input data");
        }

        $skillsArray = cleanSkills($skillsString);
        saveStudent($name, $email, $skillsArray);

        $message = "Student saved successfully";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<h2>Add Student Info</h2>

<form method="post">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="skills" placeholder="Skills (comma-separated)" required><br><br>
    <button type="submit">Save Student</button>
</form>

<p><?php echo $message; ?></p>

<?php require "footer.php"; ?>