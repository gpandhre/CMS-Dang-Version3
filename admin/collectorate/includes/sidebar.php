 <!-- Side Bar Starts Here -->

 <ul>

<div>
  <span class="logo">CMS</span>
  <button onclick=toggleSidebar() id="toggle-btn" style="margin-right:6px">
    <i class="ri-menu-line" style="font-size:2rem"></i>
  </button>
</div>

<li class="active">
  <a href="index.php">
  <i class="ri-function-fill"></i>
    <span>Dashboard</span>
  </a>
</li>

<li class="active">
  <a href="departments.php">
  <i class="ri-building-4-fill"></i>
    <span>Departments</span>
  </a>
</li>


<li class="active">
  <a href="view-departments.php">
  <i class="ri-bar-chart-2-fill"></i>
    <span>Complaints & <br> Analysis</span>
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
    <i class="ri-arrow-down-s-line"style="margin-left:3.5rem"></i>
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