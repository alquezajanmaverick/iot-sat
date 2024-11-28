    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa-solid fa-bars"></i></a></li>
            </ul>

            <ul class="nav navbar-nav float-right">
              <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link d-flex" href="#" data-toggle="dropdown">
                  <span class="d-none d-lg-inline m-auto">
                    <?php
                      if (isset($_SESSION['full_name'])) {
                        echo ucwords(strtolower(($_SESSION['full_name'])));
                      } else{
                        echo 'Guest User';
                      }
                    ?>
                    <?php
                       $name = $_SESSION['full_name'];
                       // $initials = strtolower(substr($name, 0, 1));
                       // $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&format=svg&size=48&rounded=true&background=random&color=ff0000";
                       $avatarUrl = "https://api.multiavatar.com/".urlencode($name).".svg?apikey=cepWu8RhSYB7X5";
                    ?>
                  </span>           
                  <span class="avatar ml-1 avatar-online">
                    <img src="<?php echo $avatarUrl; ?>" alt="avatar"><i></i>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right">
                    <a class="dropdown-item" href="#">
                      
                        <span class="text-bold-700">
                            <?php
                              if (isset($_SESSION['full_name'])) {
                                echo ucwords(strtolower(($_SESSION['full_name'])));
                              } else{
                                echo 'Guest User';
                              }
                            ?>
                        </span>
                      
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-user-pen"></i> Edit Profile</a>
                    <!-- <a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Do you want to logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="#" id="logoutBtn">Logout</a>
                </div>
            </div>
        </div>
    </div>