<?php include "../db.php";
session_start();

$id = intval($_GET['id']); // important
// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM properties WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $city = $_POST['city'];
    $type = $_POST['type'];
    $rooms = $_POST['rooms'];
    $bathrooms = $_POST['bathrooms'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $featured = isset($_POST['featured']) ? 1 : 0;

    // IMAGE UPLOAD
    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if($image_name != ""){
        // New image uploaded
        $upload_path = "../uploads/" . $image_name;
        move_uploaded_file($tmp_name, $upload_path);

        // Update WITH image
        $query = "UPDATE properties SET 
            name='$name',
            description='$description',
            location='$location',
            city='$city',
            type='$type',
            rooms='$rooms',
            bathrooms='$bathrooms',
            area='$area',
            price='$price',
            featured='$featured',
            image='$image_name'
            WHERE id=$id";

    } else {
        // No new image → keep old image
        $query = "UPDATE properties SET 
            name='$name',
            description='$description',
            location='$location',
            city='$city',
            type='$type',
            rooms='$rooms',
            bathrooms='$bathrooms',
            area='$area',
            price='$price',
            featured='$featured'
            WHERE id=$id";
    }

    if(mysqli_query($conn, $query)){
        $_SESSION['success'] = "Property updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update property!";
    }

    header("Location: manage_property.php");
    exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Property</title>
    <link rel="stylesheet" href="dashbord-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="properties">
        <a href="dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="left">
            <a href="manage_property.php" class="menage-left">Manage Property</a>
        </div>
        <h1 class="main-h1"><span>Add </span>Properties</h1>
        <form  method="POST" enctype="multipart/form-data">
            <input type="text" name="name" value="<?= $row['name'] ;?>">
            <textarea name="description"><?= $row['description']; ?></textarea>
            <input type="text" name="location" value="<?= $row['location'] ;?>">
            <input type="text" name="city" value="<?= $row['city']; ?>">
            <select name="type">
                <option value="buy" <?= $row['type']=='buy' ? 'selected' : '' ?>>For Buy</option>
                <option value="rent" <?= $row['type']=='rent' ? 'selected' : '' ?>>For Rent</option>
            </select>
            <input type="number" name="rooms" value="<?= $row['rooms'] ;?>">
            <input type="number" name="bathrooms" value="<?= $row['bathrooms'] ;?>">
            <input type="number" name="area" value="<?= $row['area'] ;?>">
            <input type="number" name="price" value="<?= $row['price'] ;?>">
           <div class="feature">
                <label>Featured</label> <input type="checkbox" name="featured" value="<?= $row['featured'] ? 'checked' : '' ?>">
            </div>
            <!-- Show old image -->
            <img src="../uploads/<?= $row['image']; ?>" width="120"><br><br>
            <input type="file" name="image">
            <button type="submit" name="submit" class="form-btn">Add Property</button>
        </form>
        
    </div>
    <script src="script.js"></script>
</body>
</html>