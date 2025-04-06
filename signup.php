<?php
    include 'includes/header.php';
    if(isset($_SESSION['user-authenticated']))
    {
      ?>
      <script>
        window.location.href = 'user/index.php';
      </script>
      <?php
    }
?>

<main id="main">
<?php alertMessage(); ?>
<div id="container">
  <div class="message">
    <h1 class="great">Register</h1>
    <p class="g-msg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui autem porro quibusdam minima.</p>
  </div>

  <!-- Wrapper for forms -->
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">SignUp Form</div>
    </div>
    <div class="form-container">

        <!-- Login form begins from here -->

        <form action="user/code.php" class="signup" method="POST">
        <div class="field">
            <input type="text" placeholder="Name" required name="name">
          </div>
          <div class="field">
            <input type="text" placeholder="Email Address" required name="email">
          </div>
          <div class="field">
            <input type="text" placeholder="Contact" required name="contact">
          </div>
          <div class="field">
            <input type="password" placeholder="Password" required name="password">
          </div>
          <div class="field">
            <input type="password" placeholder="Comfirm Password" required name="password">
          </div>
          <div class="pass-link"><a href="#">Already have an account?</a></div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="SignUp" name="user-signup-btn">
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