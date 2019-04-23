
<nav class="navbar navbar-expand-xl navbar-dark">
    <a href="index.php"><img id="logo" src="../UI/images/white.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php require_once __DIR__ ."/admin_menu.php";?>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="logout-button" action="logout.php" method="get"
            <?php if (!isset($_SESSION['user_id'])){ echo "hidden"; } ?>>
            <div id="username">
                <span><?php echo $_SESSION['user_name']; ?></span>
                <br>
                <span>(<?php echo $_SESSION['user_department']; ?>)</span>
            </div>
            <button type="submit" class="btn btn-danger my-2 my-sm-0" id="login">
                <i class="fa fa-sign-out" aria-hidden="true"> </i> Logout</button>
        </form>
    </div>
</nav>