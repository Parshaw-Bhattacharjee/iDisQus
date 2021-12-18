<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/index.css" />

    <title>Contact Us <?php include 'partials/_title.php'; ?></title>
</head>

<body>
    <!-- Database -->
    <?php include 'partials/_dbconnect.php'; ?>
    
    <!-- header -->
    <?php include 'partials/_header.php'; ?>

    <?php 

        $alert = FALSE;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $desc = $_POST['description'];
            $sql = "INSERT INTO `contact` (`name`, `email`, `description`, `timestamp`) VALUES ('$name','$email', '$desc', current_timestamp())";
            $result = mysqli_query($connect, $sql);
            $alert = TRUE;
            if ($alert) {
                echo
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Post is Successfully added!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>

    <!-- Contact Us -->
    <div class="container-fluid px-0 mb-3">

        <img src="https://source.unsplash.com/2500x500/?contact, phone" class="d-block w-100 mx-0" alt="Contact">

    </div>
    <div class="container mb-3 py-4">

        <h1 class="text-center border-bottom pb-2">Contact Us</h1>
        <div class="container py-5">
            <form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Tell your problem...</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descibe your problem in detail for understanding."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>

    </div>

    <!-- footer -->
    <?php include 'partials/_footer.php'; ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="js/index.js"></script>
</body>

</html>