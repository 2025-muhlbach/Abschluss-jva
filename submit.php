
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $comment = htmlspecialchars($_POST["comment"]);
    $imageName = "";

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $uploadDir = "uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir);
        }
        $imageName = basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $imageName);
    }

    $entry = "<div class='comment'><strong>" . $name . "</strong><br>" . $comment;
    if ($imageName) {
        $entry .= "<br><img src='uploads/" . $imageName . "' width='200'>";
    }
    $entry .= "</div>\n";

    file_put_contents("comments.html", $entry, FILE_APPEND);
}
header("Location: index.html");
exit;
?>
