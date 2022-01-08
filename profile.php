<?php
session_start();
include 'config.php';
include 'styles.html';

//check if user is logged in
if($_SESSION['logged']==true){
    if($_SESSION['logged']==true){
        $curUser=$_SESSION['FullNames'];
    }
}else{
    header("location:index.php");
}

//check number of customers

?>
<html>
    <head>
        <title>Macra Sacco: Home</title>
    </head>
    <body>
        <br>
        <div class="userplace"><img src="images/user.png" width="25" height="20"><?php echo $curUser ?> &nbsp;</div>
        <div class="menu">
            <div class="responsive-menu">
            <div id="menu-expand-collapse"><img src="menu.png" width="35px"></div>
            <div id="responsive-menu-list">
                <ul class="menu-item">
                <li><a href="home.php"><img src="images/db.png" width="20" height="20">&nbsp; Home</a></li>
                    <li><a href="accounts.php"><img src="images/db.png" width="20" height="20">&nbsp; Member Accounts</a></li>
                    <li><a href="deposits.php"><img src="images/db.png" width="20" height="20">&nbsp; Deposits</a></li>
                    <li><a href="withdrawals.php"><img src="images/db.png" width="20" height="20">&nbsp; Withdrawals</a></li>
                    <li><a href="loans.php"><img src="images/db.png" width="20" height="20">&nbsp; Loans</a></li>
                    <li><a href="transfers.php"><img src="images/db.png" width="20" height="20">&nbsp; Transfers</a></li>
                    <li><hr color="#1abc9c"></li>
                    <li><b>Communication</b></li>
                    <li><hr color="#1abc9c"></li>
                    <li><a href="sms.php"><img src="images/icons/phone.ico" align="left" width="18" height="18">Messages</a></li>
                    <li><a href="emails.php"><img src="images/icons/email.ico" align="left">Emails</a></li>
                    <li><hr color="#1abc9c"></li>
                    <li><b>Personal</b></li>
                    <li><hr color="#1abc9c"></li>
                    <li><a href="profile.php"><img src="images/profile.png" width="25" height="25" align="left">&nbsp; Profile</a></li>
                    <li> <a href="personalsettings.php"><img src="images/settings.png" width="25" height="25" align="left">&nbsp; Settings</a></li>
                    <li><a href="index.php"><img src="images/logout.png" width="23" height="23" align="left">&nbsp; Log out</a></li>
                </ul>
               
                </div>
            </div>
   
        
        
        
        
        </div>  
        <?php
        $qry=mysqli_query($config,"SELECT * FROM dbusers WHERE fullnames='$curUser'");
        $row=mysqli_fetch_assoc($qry);
        $names=$row['fullnames'];
        $username=$row['username'];
        $email=$row['emailaddress'];
        $phone=$row['phonenumber'];
        $regdate=$row['regdate'];
        
        ?>
        <br>
        <div class="bodycontent" style="background-color: white;">
        <img src="images/user.png" width="200" height="150" align="left"><ul><li>Names: <?php echo $names ?></li>
        <li>Username: <?php echo $username ?></li>
        <li>Email Address: <?php echo $email ?></li>
        <li>Phone Number: <?php echo $phone ?></li>
        <li>Date Registered: <?php echo $regdate ?></li>
</ul>
<p>
<table width="30%" align="left">
    <tr><td><button class="buttonstyle"><a href="changepassword.php"><img src="images/edit.png" width="20" height="20" align="left">Change my password</a></button></td></tr>
</table>
</p>
        </div>
        <div class="footer">Created and maintained by Macra Systems</div>
    </body>
</html>