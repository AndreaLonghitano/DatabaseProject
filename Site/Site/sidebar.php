<div class="main-sidebar" style="background-color:black;color:white;">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <p><strong>Meeting's Site</strong></p>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <?php
                    if ($photo==null)echo '<img alt="image" src="ImageProfile/ignota.jpg">';
                    else echo '<img alt="image" src="'.$photo.'">';
             ?>
            </div>
            <div class="sidebar-user-details">
                <div class="user-name"><?php echo $name. " ".$surname ?></div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Info</li>
            <li>
              <a href="dashboard.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>

            <li>
              <a href="YourProfile.php"><i class="fas fa-user-alt"></i><span>Your Profile</span></a>
            </li>
            <li>
              <a href="BusinessCard.php"><i class="far fa-address-card"></i><span>Business Cards</span></a>
            </li>
            <li>
              <a href="Meetings.php"><i class="fab fa-meetup"></i><span>Meetings</span></a>
            </li>
              <li>
              <a href="MeetingRoom.php"><i class="fas fa-globe"></i><span>Meeting Room</span></a>
            </li>
            </ul>
        </aside>
      </div>