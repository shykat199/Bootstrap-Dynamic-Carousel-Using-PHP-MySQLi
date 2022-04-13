<?php

include "_dbconnect.php";
$msg = "";

if (isset($_POST['uploaad'])) {
    $image = $_FILES['image']['name'];

    $path = 'images/' . $image;

    /* print_r($path);
        print_r($image);
 */
    $sql = $con->query("INSERT INTO `carousel`(`image_path`) VALUES ('$path')");

    if ($sql) {
        # code...
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $msg = "Image Uploaded Successfully";
    } else {
        $msg = "Image Not Uploaded";
    }
}


$result = $con->query("SELECT `image_path` FROM carousel");

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Dynamic Carousel</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center bg-dark text-light pb-2">Welcome to Bootstrape Dynamic Carousel Using Php and mysql</h2>
    </div>

    <div class="container ">
        <div class="row justify-content-center mb-2">
            <div class="col-lg-10">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php
                        $i = 0;
                        foreach ($result as $row) {
                            $active = "";
                            if ($i == 0) {
                                # code...
                                $active = 'active';
                            }
                        ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?= $i; ?> class=<?= $active ?> aria-current="true" aria-label="Slide 1"></button>
                        <?php

                            $i++;
                        }

                        ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($result as $row) {
                            $active = "";
                            if ($i == 0) {
                                # code...
                                $active = 'active';
                            }
                        ?>
                            <div class="carousel-item <?= $active ?>">
                                <img src="<?= $row['image_path']; ?>" width="100%" height="400">
                            </div>
                        <?php
                            $i++;
                        }

                        ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 bg-dark rounded px-4">
                <h4 class="text-center text-light p-1">Select Image to Upload</h4>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group pb-2">
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="form-group pb-2">
                        <input type="submit" name="uploaad" class="btn btn-warning btn-block" value="Upload Image">
                    </div>
                    <div class="form-group">
                        <h5 class="text-center text-light"><?= $msg; ?></h5>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>