<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
</head>
<body>
    <h1>Image Upload Form</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br>

        <input type="submit" value="Upload">
    </form>
</body>
</html>
