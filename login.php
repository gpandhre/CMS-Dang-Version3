<?php
    include 'includes/header.php';
    if(isset($_SESSION['admin-authenticated']))
    {
      ?>
      <script>
        window.location.href = 'admin/collectorate/index.php';
      </script>
      <?php
    }
?>

<main id="main">
<?php alertMessage(); ?>
<div id="container">
  <div class="message">
    <h1 class="great">Welcome,</h1>
    <p class="g-msg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui autem porro quibusdam minima.</p>
  </div>

  <!-- Wrapper for forms -->
  <div class="loginform-wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
    </div>
    <div class="form-container">

        <!-- Login form begins from here -->

        <form action="login-code.php" class="login" method="POST">
          <div class="field">
            <input type="text" placeholder="Email Address" required name="email">
          </div>
          <div class="field">
            <input type="password" placeholder="Password" required name="password">
          </div>
          <div class="pass-link"><a href="#">Forgot password?</a></div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login" name="admin-login-btn">
          </div>
          
        </form>

        <!-- Login form ends here -->
    </div>
    <!-- Form Container Ends Here -->
  </div>
  <!-- Wrapper Ends Here -->
</div>

</main>
<?php
    include 'includes/footer.php';
?>