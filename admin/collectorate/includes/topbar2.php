<!-- Section for Login and Sign Up buttons -->

<div id="topbar2">

    <?php if(!$_SESSION['admin-authenticated']):?>
    <div class="navigation">
    <a href="#home">Home</a>
    <a href="#news">News</a>
    <div class="dropdown">
        <button class="dropbtn">Complaints
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="#">Category</a>
        <a href="#">Solutions</a>
        <a href="#">Problems</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Complaints Analysis
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="#">Analysis</a>
        <a href="#">Reactions</a>
        <a href="#">Benefits</a>
        </div>
    </div>
    </div>
    <?php endif;?>

    <div id="login-signup">
        <?php if($_SESSION['admin-authenticated']):?>
            <div class="details">
                <h2>Hi, <?=$_SESSION['auth_admin']['username']?></h2>
            </div>
            <?php endif;?>

            <?php if(!$_SESSION['admin-authenticated']):?>

            <div class="login-wrapper">
                <a><button id="login">Login</button></a>
                <a href="signup.php"><button id="signup">Sign Up</button></a>
            </div>
            <?php endif;?>

            <?php if($_SESSION['admin-authenticated']):?>
              
            <div class="login-wrapper" style="width:25%;">
                <a href="logout.php" style="width:100%"><button id="logout">Log out</button></a>
            </div>
            <?php endif;?>
            
            <div id="user-admin">
                <h2>You want to login as ?</h2>
                <div class="wrap">

                    <form action="login.php" method="POST">
                        <input type="submit" name="adim-login" value="Admin">
                    </form>
                
                    <form action="login.php" method="POST">
                        <input type="submit" name="user-login" value="User">
                    </form>
                </div>
            </div>
    </div>
</div>

<!-- Section for Login and Sign Up buttons ends here -->