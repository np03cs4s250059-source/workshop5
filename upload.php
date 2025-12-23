<?php
require "header.php";
require "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        $message = "File uploaded successfully: " . $fileName;
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio" required><br><br>
    <button type="submit">Upload</button>
</form>

<p><?php echo $message; ?></p>

<?php require "footer.php"; ?>