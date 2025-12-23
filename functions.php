<?php

function formatName($name)
{
    return ucwords(trim($name));
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string)
{
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudent($name, $email, $skillsArray)
{
    $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    if (!file_put_contents("students.txt", $data, FILE_APPEND)) {
        throw new Exception("Unable to save student data");
    }
}

function uploadPortfolioFile($file)
{
    if ($file["error"] !== 0) {
        throw new Exception("File upload error");
    }

    $allowedTypes = ["application/pdf", "image/jpeg", "image/png"];
    if (!in_array($file["type"], $allowedTypes)) {
        throw new Exception("Invalid file type");
    }

    if ($file["size"] > 2 * 1024 * 1024) {
        throw new Exception("File size exceeds limit");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Upload directory not found");
    }

    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
    $newName = strtolower(str_replace(" ", "_", pathinfo($file["name"], PATHINFO_FILENAME)));
    $finalName = $newName . "_" . time() . "." . $ext;

    if (!move_uploaded_file($file["tmp_name"], "uploads/" . $finalName)) {
        throw new Exception("Failed to store file");
    }

    return $finalName;
}