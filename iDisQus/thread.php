<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/index.css" />

    <title>Discussion <?php include 'partials/_title.php'; ?></title>
</head>

<body>
    <!-- Database -->
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- header -->
    <?php include 'partials/_header.php'; ?>

    <?php 
        $thread_id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id = $thread_id";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $thread_title = $row['thread_title'];
            $thread_description = $row['thread_description'];
            $thread_user_id = $row['thread_user_id'];
            $sql1 = "SELECT username FROM `users` WHERE user_id = $thread_user_id";
            $result1 = mysqli_query($connect, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
        }
    ?>

    <?php 
        $alert = FALSE;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desc = $_POST['discussion_content'];
            $desc = str_replace("<", "&lt;", $desc);
            $desc = str_replace(">", "&gt;", $desc);
            $user_id = $_POST['user_id'];
            $sql = "INSERT INTO `discussions` (`discussion_content`, `discussion_thread_id`, `posted_by`, `timestamp`) VALUES ('$desc', '$thread_id', '$user_id', current_timestamp())";
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

    <div class="container p-5 mb-4 bg-light border-top round-3">
        <h1 class="display-5 fw-bold"><?php echo $thread_title?></h1>
        <p class="lead border-top pt-2"><?php echo $thread_description?></p>
        <p class="border-top pt-2">This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums
            is not allowed. Do not
            post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
            questions. Remain respectful of other members at all times.</p>
        <div class="d-flex pt-3">
            <div class="flex-shrink-0 mr-3">
                <img src="images/default_user.png" width="65px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <h6>Posted By:</h6>
                <b><?php echo $row1['username']?></b>
            </div>
        </div>
    </div>

    <div class="container pb-3 border-bottom">
        <div class="mb-3">
            <p class="d-flex py-2 align-items-center text-dark fw-bold text-decoration-none fs-2 border-bottom">
                Post your Comments
            </p>
        </div>

        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo 
        '
        <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post your Comment</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="discussion_content"
                    placeholder="Post your Comment." rows="3"></textarea>
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
                    You are not Logged In to post a comment. Kindly, Log In to post comment.
                </p>
            </div>
            ';
        }
        ?>
    </div>

    <div class="container" style="min-height: 500px;">
        <p class="d-flex py-2 align-items-center text-dark fw-bold text-decoration-none fs-2 border-bottom">
            Discussions
        </p>
        <?php 
            $thread_id = $_GET['threadid'];
            $sql = "SELECT * FROM `discussions` WHERE discussion_thread_id = $thread_id";
            $result = mysqli_query($connect, $sql);
            $fetch = FALSE;
            while ($row = mysqli_fetch_assoc($result)) {
                $discussion_id = $row['discussion_id'];
                $discussion_content = $row['discussion_content'];
                $posted_by = $row['posted_by'];
                $timestamp = $row['timestamp'];
                $sql1 = "SELECT username FROM `users` WHERE user_id = $posted_by";
                $result1 = mysqli_query($connect, $sql1);
                $row1 = mysqli_fetch_assoc($result1);
                $fetch = TRUE;
                echo '
                <div class="d-flex border-bottom py-3">
                    <div class="flex-shrink-0 mr-3">
                        <img src="images/default_user.png" width="54px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6>'. $row1['username'] .' ['. $timestamp .']</h6>
                        '. $discussion_content .'
                    </div>
                </div>
                ';
            }

            if (!$fetch) {
                echo
                '<div class="p-2 text-center bg-light border rounded-3">
                    <h5> No Discussions Found!</h5>
                    <p>Be the first to post a comment!</p>
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