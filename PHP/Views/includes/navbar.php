<!-- navbar -->

<div class="wrapper">
        <div class="rectangle1"> 
            <nav class="navbar">
                <div class="logo">
                    <a href="home.php"><img src="./assets/image/logo-small.png" alt="logo"></a>
                </div>
                <input type="checkbox" id="click">
                <label for="click" class="menu-btn">
                    <i class="fas fa-bars"></i>
                </label>
                <ul class="menu">
                    <li><button class="box"><a href="#" class="first">Book Now</a></button></li>
                    <li><button class="box-two"><a href="prices.php" class="two"> Prices & Services</a></button></li>
                    <li><a href="#" class="three">Warranty</a></li>
                    <li><a href="#" class="three">Blog</a></li>
                    <li><a href="contact.php" class="three">Contact</a></li>
                    <li><button class="box-three"><a href="#" class="four" data-toggle="modal" data-target="#loginmodal">Login</a></button></li>
                    <li><button class="box-four"><a href="become_a_pro.php" class="five">Become a helper</a></button></li>
                    
                </ul>
            </nav>
        </div>


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
        <form action="http://localhost/Helperland/?controller=Helperland&function=login" method="post"  autocomplete="off">
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
            <input type="email" name="email" placeholder="E-mail Adress" style="padding: 5px; width:100%"><br><br>
           
            <button name="submit" class="btn btn-secondary btn-block">Send</button><br>
        
        </form>
      </div>
      
    </div>
  </div>
</div>
