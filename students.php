<?php
require "header.php";

if (!file_exists("students.txt")) {
    echo "<p>No student data found</p>";
} else {
    $lines = file("students.txt", FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($name, $email, $skills) = explode("|", $line);
        $skillsArray = explode(",", $skills);

        echo "<p>";
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong> ";
        print_r($skillsArray);
        echo "</p><hr>";
    }
}

require "footer.php";