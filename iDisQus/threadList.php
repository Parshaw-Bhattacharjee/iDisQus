<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/index.css" />

    <title>Discussion
        <?php include 'partials/_title.php'; ?>
    </title>
</head>

<body>
    <!-- Database -->
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- header -->
    <?php include 'partials/_header.php'; ?>

    <?php 
        $category_id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id = $category_id";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $category_name = $row['category_name'];
            $category_description = $row['category_description'];
        }
    ?>

    <?php 
        $alert = FALSE;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['thread_title'];
            $desc = $_POST['thread_description'];
            $title = str_replace("<", "&lt;", $title);
            $title = str_replace(">", "&gt;", $title);
            $desc = str_replace("<", "&lt;", $desc);
            $desc = str_replace(">", "&gt;", $desc);
            $user_id = $_POST['user_id'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`, `timestamp`) VALUES ( '$title', '$desc', '$category_id', '$user_id', current_timestamp())";
            $result = mysqli_query($connect, $sql);
            $alert = TRUE;
            if ($alert) {
                echo
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread is Successfully added!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>

    <div class="p-5 mb-4 text-white bg-dark border-top">
        <div class="container">
            <h1 class="display-5 fw-bold">Welcome to
                <?php echo $category_name?> Forum
            </h1>
            <p class="lead">
                <?php echo $category_description?>
            </p>
            <p class="border-top pt-2">This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums
                is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
        </div>
    </div>

    <div class="container pb-3 border-bottom">
        <div class="mb-3">
            <p class="d-flex py-2 align-items-center text-dark fw-bold text-decoration-none fs-2 border-bottom">
                Start A New Thread
            </p>
        </div>

        <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo 
    '
        <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="thread_title"
                aria-describedby="help">
            <div id="help" class="form-text">Should be crisp & short.</div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="thread_description"
                    placeholder="Elaborate the Problem for understanding." rows="3"></textarea>
            </div>
            <input type="hidden" name="user_id" value="'. $_SESSION["user_id"]. '">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        ';
    }
    else {
        echo
        '
        <div class="mb-3">
            <p class="d-flex py-2 align-items-center text-dark text-decoration-none">
                You are not Logged In to start a new discussion. Kindly, Log In to start a new discussion.
            </p>
        </div>
        ';
    }
    ?>

    </div>

    <div class="container" style="min-height: 500px;">
        <p class="d-flex py-2 align-items-center text-dark fw-bold text-decoration-none fs-2 border-bottom">
            Browse Topics
        </p>
        <?php 
            $category_id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_category_id = $category_id";
            $result = mysqli_query($connect, $sql);
            $fetch = FALSE;
            while ($row = mysqli_fetch_assoc($result)) {
                $thread_id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_description = $row['thread_description'];
                $thread_user_id = $row['thread_user_id'];
                $timestamp = $row['timestamp'];
                $sql1 = "SELECT username FROM `users` WHERE user_id = $thread_user_id";
                $result1 = mysqli_query($connect, $sql1);
                $row1 = mysqli_fetch_assoc($result1);
                $fetch = TRUE;
                echo '
                <div class="d-flex border-bottom py-3">
                    <div class="flex-shrink-0 mr-3">
                        <img src="images/default_user.png" width="54px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5><a href="thread.php?threadid='. $thread_id .'" class="link-info text-decoration-none">'. $thread_title .'</a></h5>
                        '. $thread_description .'
                    </div>
                    <div class="font-weight-bold my-0">
                        Posted By: <h6>'. $row1['username'] .' ['. $timestamp .']</h6>
                    </div>
                </div>
                ';
            }

            if (!$fetch) {
                echo
                '<div class="p-2 text-center bg-light border rounded-3">
                    <h5> No Threads Found!</h5>
                    <p>Be the first to post a Discussion!</p>
                </div>';
            }
        ?>

    </div>

    <!-- footer -->
    <?php include 'partials/_footer.php'; ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="js/index.js"></script>
</body>

</html>