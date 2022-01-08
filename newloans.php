<?php

session_start();
//check if user is logged in

if ($_SESSION['logged'] == true) {
    if ($_SESSION['logged'] == true) {
        $curUser = $_SESSION['FullNames'];
        //$depositerror = "";
    }
} else {
    header("location:index.php");
}
include 'config.php';
$qry=mysqli_query($config,"SELECT * FROM loans ORDER BY id DESC");
include 'styles.html';
?>
<?php
//add deposit

if ($_POST['submit']) {
    $qry = mysqli_query($config, "SELECT * FROM transactions ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($qry);
    if (mysqli_num_rows($qry) < 1) {
        $tnum = "LN000001";
    } else {
        $id = $row['id'];
        $newid = $id + 1;
        if ($id < 10) {
            if ($id < 10) {
                $tnum = "LN00000" . $newid . '';
            } else {
                if ($id < 100) {
                    $tnum = "LN0000" . $newid . '';
                } else {
                    if ($id < 1000) {
                        $tnum = "LN000" . $newid . '';
                    } else {
                        if ($id < 10000) {
                            $tnum = "LN0" . $newid . '';
                        } else {
                            if ($id < 100000) {
                                $tnum = "LN0" . $newid . '';
                            } else {
                                $tnum = "LN" . $newid . '';
                            }
                        }
                    }
                }
            }
        }
    }
}
$tname = "Deposit";
$accountno = $_POST['accountno'];
$qry = mysqli_query($config, "SELECT * FROM accounts WHERE id='$accountno'");
$row = mysqli_fetch_assoc($qry);
$accountname = $row['FirstName'] . ' ' . $row['OtherNames'];
if (mysqli_num_rows($qry) > 0) {
    $qry = mysqli_query($config, "SELECT * FROM transactions WHERE accountno='$accountno' ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($qry);
    if (mysqli_num_rows($qry) > 0) {
        $prevbalance = $row['accbal'];
        $amount = $_POST['amount'];
        $accbal = $prevbalance + $amount;
        $tmonth = date('M-Y');
        $sessionuser = $_SESSION['MM_Username'];
    } else {
        $prevbalance = "0.0";
        $amount = $_POST['amount'];
        $accbal = $prevbalance + $amount;
        $tmonth = date('M-Y');
        $sessionuser = $_SESSION['MM_Username'];
    }
    $loanamount=$_POST['amount'];
    $loantype=$_POST['loantype'];
    if($qry = mysqli_query($config, "INSERT INTO transactions(tid,tname,accountno,accountnames,prevbal,tamount,accbal,tmonth,sessionuser) VALUES('$tnum','$tname','$accountno','$accountname','$prevbalance','$amount','$accbal','$tmonth','$sessionuser')")){
        mysqli_query($config,"INSERT INTO loans(accnum,accname,loantype,loanamount,inerestrate,interestamount,repaymentperiod,monthlyrepayment,loanagent) VALUES('$accountno','$accountname') ");
        $depositerror = '<img src="images/success.png" width="25" height="25" align="left"> Transaction ' . $tnum . ' was successful. Ksh.' . $amount . ' has been deposited to account number ' . $accountno . ' account name ' . $accountname . '.';
    }else{
        $depositerror = '<img src="images/error.png" width="25" height="25" align="left"> Error! Transaction failed!';
    }
    
} else {
    $depositerror = '<img src="images/error.png" width="25" height="25" align="left"> Error! Account number does not exist!';
}
?>
<br>
<div class="userplace"><img src="images/user.png" width="25" height="20"><?php echo $curUser ?> &nbsp; </div>
<div class="menu">
<div id="responsive-menu-list">
                <ul class="menu-item">
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
<table align="right" width="80%" bgcolor="cyan">
    <tr>
        <td width="13%"><a href="newloans.php"><img src="images/loans.png" align="left" height="20" width="20">New Loan</a></td>
        <td>

        </td>
    </tr>
</table><br>
<br>
<table align="right" width="80%" bgcolor="cyan" class="table">
    <tr>
        <td>
            <form name="loanform" method="POST" action="">
                <table width="50%" align="center">
                    <tr>
                        <td>Account Number: *</td>
                        <td><input type="text" name="accountno" size="32"></td>
                    </tr>
                    <tr>
                        <td>Account Name: </td>
                        <td><input type="text" name="accountname" size="32" readonly</td> </tr> <tr>
                        <td>Loan Amount: *</td>
                        <td><input type="text" name="amount" size="32"></td>
                    </tr>
                    <tr>
                        <td>Guarantor 1 Account: *</td>
                        <td><input type="text" name="firstguarantor" size="32"></td>
                    </tr>
                    <tr>
                        <td>Guarantor 2 Account: *</td>
                        <td><input type="text" name="secondguarantor" size="32"></td>
                    </tr>
                    <tr>
                        <td>Loan Type: *</td>
                        <td><select cols="32">
                                <option>Business Loan</option>
                                <option>Personal Loan</option>
                                <option>Milk Advance</option>
                                <option>Coffee Advance</option>
                                <option>Asset Loan</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Deposit"></td>
                    </tr>
            </form>
</table>
<table align="right" width="80%" bgcolor="cyan">
    <tr>
        <td><?php echo '<i>' . $depositerror . '</i>' ?></td>
    </tr>
</table>
</td>
</table>