<!-- navbar -->

<div class="wrapper">
        <div class="rectangle">
            <img src="./assets/image/become-a-pro-banner.png" alt="banner">
            <nav class="navbar">
                <div class="logo">
                    <img src="./assets/image/white-logo-transparent-background.png" alt="logo">
                </div>
                <ul class="menu">
                    <li><button class="box"><a href="#" class="first">Book a Cleaner</a></button></li>
                    <li><a href="prices.php" class="three">Prices</a></li>
                    <li><a href="#" class="three">Our Guarantee</a></li>
                    <li><a href="#" class="three">Blog</a></li>
                    <li><a href="contact.php" class="three">Contact Us</a></li>
                    <li><button class="box-three"><a href="#" data-toggle="modal" data-target="#loginmodal" class="four">Login</a></button></li>
                    <li><button class="box-four"><a href="become_a_pro.php" class="five">Become a helper</a></button></li>

                </ul>
            </nav>

<!--Login  Modal -->

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
        <form action="" method="post"  autocomplete="off">
            <input type="email" name="email" placeholder="E-mail" style="padding: 5px; width:90%"><span class="float-right"><i class="fas fa-user fa-2x"></i></span><br><br>
            <input type="password" name="password" id="" placeholder="Password" style="padding: 5px; width:90%"><span class="float-right"><i class="fas fa-lock fa-2x"></i></span><br><br>
            <input type="checkbox" name="" id=""> Save on Computer <br><br>
            <button type="button" class="btn btn-secondary btn-block">Log in</button><br>
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
        <form action="" method="post"  autocomplete="off">
            <input type="email" name="email" placeholder="E-mail Adress" style="padding: 5px; width:100%"><br><br>
           
            <button type="button" class="btn btn-secondary btn-block">Send</button><br>
        
        </form>
      </div>
      
    </div>
  </div>
</div>