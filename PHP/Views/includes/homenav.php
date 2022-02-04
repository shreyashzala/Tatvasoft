<!-- Home Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-light">
    <a class="navbar-brand" href="#"><img src="./assets/image/white-logo-transparent-background.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse float-right" id="navbarNavDropdown">
      <ul class="navbar-nav ">
        <li class="nav-item link1">
          <a class="nav-link box-5" id="box-1" href="#">Book a Cleaner </a>
          <a class="nav-link box-5" href="prices.php">Prices</a>
          <a class="nav-link box-5" href="#">Our Guaruntee</a>
          <a class="nav-link box-5" href="#">Blog</a>
          <a class="nav-link box5" href="contact.php">Contact Us</a>

        </li>

        <li class="nav-item ">
          <a class="nav-link " id="box-2" href="" data-toggle="modal" data-target="#loginmodal">Login </a>

        </li>
        <li class="nav-item ">
          <a class="nav-link" id="box-3" href="become_a_pro.php">Become a Helper </a>

        </li>
      </ul>
    </div>
  </nav>
 
<!-- Modal -->



<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginmodalLabel">Log in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="http://localhost/Helperland/?controller=Helperland&function=login" method="post" autocomplete="off">
            <input type="email" name="email" placeholder="E-mail" style="padding: 5px; width:90%"><span class="float-right"><i class="fas fa-user fa-2x"></i></span><br><br>
            <input type="password" name="password" id="" placeholder="Password" style="padding: 5px; width:90%"><span class="float-right"><i class="fas fa-lock fa-2x"></i></span><br><br>
            <input type="checkbox" name="" id=""> Save on Computer <br><br>
            <button name="submit" class="btn btn-secondary btn-block">Log in</button><br>
        <div class="text-center">
        <a href="#" data-toggle="modal" data-target="#forgotpassmodal" data-dismiss="modal">Forgot Password</a><br>
        <span>Don't have account yet? <br>
        <a href="register.php">create account</a></span>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--Forgot Password Modal -->

<div class="modal fade" id="forgotpassmodal" tabindex="-1" role="dialog" aria-labelledby="forgotpassmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotpassmodalLabel">Forgot Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="http://localhost/Helperland/?controller=Helperland&function=forgotpass" method="post"  autocomplete="off">
            <input type="email" name="email" placeholder="E-mail Address" style="padding: 5px; width:100%"><br><br>
           
            <button name="submit" class="btn btn-secondary btn-block">Send</button><br>
        
        </form>
      </div>
    </div>
  </div>
</div>
