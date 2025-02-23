<style>

.container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 60vh;
    }

   
    .login-box {
      width: 100%;
      max-width: 600px;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

   
    .login-header {
      background-color: #b9A37E;
      color: #ffffff;
      padding: 15px;
      text-align: center;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

  
    .login-body {
      padding: 20px;
    }

    
    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input.box {
      width: 100%;
      max-width: 500px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

  
    .form-submit {
      text-align: center;
    }

    .form-submit input {
      background-color: orange;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

   
    .error-message {
      font-size: 11px;
      color: #cc0000;
      margin-top: 10px;
      text-align: center;
    }
</style>

<?php

	$error ='';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['error_msg'])){
	$error = $_SESSION['error_msg'];
}
?>
  
   <div align="center" style="margin-top:50px;" class="container">
    <div style="width:600px; height: 390px; border: solid 1px #333333; " align="left" class="login-box">
     <div class="login-header"><b>Login</b></div>
     <div style="margin:30px">
	 
      <form action="check_login.php" method="post">
        <label>UserName  :</label><input type="text" name="username" placeholder= "Username" class="box"/><br /><br />
        <label>Password  :</label><input type="password" name="password" placeholder= "Password" class="box" /><br/><br />
        <img id="imgcap" onclick="reloadCaptcha();return false;" src="inc/captcha.php?captcha=true" alt="CAPTCHA" width="100" height="30"><br/>
		<label>CAPTCHA  :</label><input id="captcha" placeholder="captcha" style="width:110px" name="captcha" class="box">
        <div class="form-submit">
        <input type="submit" value=" Submit "/><br />
        </div>
      </form>
	  
	  
      <div style="font-size:11px; color:#cc0000; margin-top:10px; text-align: center;"><?php echo $error; ?></div>
     </div>
    </div>
   </div>
   
<?php
	$_SESSION['error_msg'] = '';
?>