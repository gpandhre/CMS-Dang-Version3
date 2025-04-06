 <!-- Side Bar Starts Here -->

 <ul>

<div>
  <span class="logo">CMS</span>
  <button onclick=toggleSidebar() id="toggle-btn">
    <i class="ri-menu-line"></i>
  </button>
</div>

<li class="active">
  <a href="home.php">
    <i class="ri-home-4-fill"></i>
    <span>Home</span>
  </a>
</li>

<li class="active">
  <a href="dashboard.php">
  <i class="ri-function-fill"></i>
    <span>Dashboard</span>
  </a>
</li>

<li class="active">
  <a href="file-complaint.php">
    <i class="ri-file-edit-fill"></i>
    <span>File Complaint</span>
  </a>
</li>

<li class="active">
  <a href="file-complaint.php">
    <i class="ri-bar-chart-2-fill"></i>
    <span>Complaints & Analysis</span>
  </a>
</li>



<li>
  <a href="#">
    <i class="ri-guide-fill"></i>
    <span>Guide</span>
  </a>
</li>

<!-- Checking if the authentication is done or not.
 if the authentication is done the profile section will
 contain user's name and manage account option -->

<?php if(isset($_SESSION['admin-authenticated'])):?>
<li>

  <button onclick=toggleSubMenu(this) class="dropdown-btn">
    <i class="ri-profile-fill"></i>
    <span>Profile</span>
    <i class="ri-arrow-down-s-line"style="margin-left:3rem"></i>
  </button>
  
  <ul class="sub-menu">
    <div>
      <li><a href="#">Personal Info</a></li>
      <li><a href="#">Security & Privacy</a></li>
    </div>
  </ul>
  
</li>
<?php endif ?>

<!-- Checking if the authentication is done or not.
 if the authentication is not done the profile section will not
 contain user's name and manage account option -->

<?php if(!isset($_SESSION['admin-authenticated'])):?>
  
  <li>
  <a href="login.php">
    <i class="ri-profile-fill"></i>
    <span>Profile</span>
  </a>
</li>

<?php endif ?>

</ul>

  <!-- Side Bar Ends Here -->