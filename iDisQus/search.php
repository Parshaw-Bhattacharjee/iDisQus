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

    <!-- search -->
    <div class="container" style="min-height: 670px;">
        <p class="d-flex py-2 align-items-center text-dark fw-bold text-decoration-none fs-2 border-bottom">
            Search Results for <em class="px-2">'<?php echo $_GET['search'] ?>'</em>
        </p>
        <?php 
            $query = $_GET["search"];
            $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_description) AGAINST ('$query' IN BOOLEAN MODE)";
            $result = mysqli_query($connect, $sql);
            $fetch = FALSE;
            while ($row = mysqli_fetch_assoc($result)) {
                $thread_id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_description = $row['thread_description'];
                $url = "thread.php?threadid='. $thread_id .'";
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
                        <h5><a href="'. $url .'" class="link-info text-decoration-none">'. $thread_title .'</a></h5>
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
                '<div class="p-2 bg-light border rounded-3">
                    <h5 class="text-center"> No Results Found!</h5>
                    <p class="lead px-3"> Suggestions: 
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords. </li>
                        </ul>
                    </p>
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