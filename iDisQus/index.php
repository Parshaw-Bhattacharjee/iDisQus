<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/index.css" />

    <title>Home <?php include 'partials/_title.php'; ?></title>
</head>

<body>
    <!-- Database -->
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- header -->
    <?php include 'partials/_header.php'; ?>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2500x600/?coding, programming" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2500x600/?ethical, hacking" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2500x600/?gaming, video" class="d-block w-100" alt="..." />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- card -->

    <div class="container flex-wrap justify-content-between align-items-center py-auto my-auto border-top">

        <!-- Categories -->

        <h2 class="text-center my-4 px-3"><u>iDisQus - Browse Categories</u></h2>

        <!-- Items -->
        <div class="row">
            <?php 
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id'];
                $category_name = $row['category_name'];
                $category_description = $row['category_description'];
                echo '
                <div class="col-md-4 my-2">
                    <div class="card h-100" style="width: 100">
                        <img src="https://source.unsplash.com/2500x1750/?coding, programming, '. $category_name .'" class="card-img-top" alt="'. $category_name .'" />
                        <div class="card-body">
                            <h5 class="card-title">'. $category_name .'</h5>
                            <p class="card-text">
                                '. substr($category_description, 0, 90) .'...
                            </p>
                            <a href="threadlist.php?catid=' . $category_id . '" class="btn btn-primary">Browse</a>
                        </div>
                    </div>
                </div>             
                ';
            }
        ?>
        </div>
    </div>

    <!-- footer -->
    <?php include 'partials/_footer.php'; ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="js/index.js"></script>
</body>

</html>