<?php include "../db.php"; 
$result = mysqli_query($conn, "SELECT * FROM properties");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Listings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="dashbord-style.css">
</head>
<body>
    <div class="listing-container">
        <a href="dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="left">
            <a href="manage_property.php" class="menage-left">Manage Property</a>
        </div>
        <h1 class="main-h1"><span>Add </span>Properties</h1>
        <div class="listing-cards">
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="cards">
                <div class="img-box">
                    <img src="../uploads/<?= $row['image']; ?>" alt="house image">
                </div>
                <h2><?= $row['name']; ?></h2>
                <span><i class="fa-solid fa-location-dot"></i> <?= $row['location']; ?></span>
                <p class="price"><?= number_format($row['price']); ?></p>
                <div class="sell-rent">
                    <p><?= ucfirst($row['type']); ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>