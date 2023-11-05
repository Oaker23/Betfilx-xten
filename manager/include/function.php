<?php
// Start function dashboard
function sumDeposit($start_date,$end_date)
{
    // $x = 10;
    // echo $x;
    include("../config/config.php");
    if ($start_date == "" && $end_date == "") {
        $sql="SELECT SUM(amount) AS total_amount FROM refill WHERE status = 1 and amount > 0 ";
        $result = $server->query($sql);
        $row = mysqli_fetch_assoc($result);
        $total_amount=$row['total_amount'];
        // echo $total_amount;
        if ($total_amount == "") {
            echo 0;
        }else {
            echo number_format($total_amount);
        }
    }else {
        // $filler_start_date=date("d/m/Y", strtotime($start_date));
        // $filler_end_date=date("d/m/Y", strtotime($end_date));
        $sql="SELECT SUM(amount) AS total_amount FROM refill WHERE `date_check` between '".$start_date."' and '".$end_date."' and status = 1 and amount > 0";
        $result = $server->query($sql);
        $row = mysqli_fetch_assoc($result);
        $total_amount=$row['total_amount'];
        if ($total_amount == "") {
            echo 0;
        }else {
            echo number_format($total_amount);
        }

    }
    

}

function sumWithdraw($start_date,$end_date)
{
    include("../config/config.php");

    if ($start_date == "" && $end_date == "") {
        $sql="SELECT SUM(credit) AS total_amount FROM withdraw WHERE status = 0 ";
        $result = $server->query($sql);
        $row = mysqli_fetch_assoc($result);
        $total_amount=$row['total_amount'];
        // echo $total_amount;
        if ($total_amount == "") {
            echo 0;
        }else {
            echo number_format($total_amount);
        }
    }else {
        // $filler_start_date=date("d/m/Y", strtotime($start_date));
        // $filler_end_date=date("d/m/Y", strtotime($end_date));
        $sql="SELECT SUM(credit) AS total_amount FROM withdraw WHERE status=0 AND `date_withdraw` between '".$start_date."' AND '".$end_date."' ";
        $result = $server->query($sql);
        $row = mysqli_fetch_assoc($result);
        $total_amount=$row['total_amount'];
        if ($total_amount == "") {
            echo 0;
        }else {
            echo number_format($total_amount);
        }

    }
}

function sumProfit($start_date,$end_date)
{
    include("../config/config.php");

    if ($start_date == "" && $end_date == "") {
        $sql_withdraw="SELECT SUM(credit) AS total_amount FROM withdraw WHERE status=0  ";
        $result_withdraw = $server->query($sql_withdraw);
        $row_withdraw = mysqli_fetch_assoc($result_withdraw);
        $total_amount_withdraw=$row_withdraw['total_amount'];

        $sql_deposit="SELECT SUM(amount) AS total_amount FROM refill WHERE status = 1 and amount > 0";
        $result_deposit = $server->query($sql_deposit);
        $row_deposit = mysqli_fetch_assoc($result_deposit);
        $total_amount_deposit=$row_deposit['total_amount'];

        $sql_affliliate="SELECT SUM(credit) AS total_credit FROM history_affliliate WHERE  credit > 0";
        $result_affliliate = $server->query($sql_affliliate);
        $row_affliliate = mysqli_fetch_assoc($result_affliliate);
        $total_amount_affliliate=$row_affliliate['total_credit'];

        $sql_refund="SELECT SUM(credit) AS total_credit FROM history_refund WHERE  credit > 0";
        $result_refund = $server->query($sql_refund);
        $row_refund = mysqli_fetch_assoc($result_refund);
        $total_amount_refund=$row_refund['total_credit'];

        $sumTotalAmount = $total_amount_deposit-$total_amount_withdraw-$total_amount_affliliate-$total_amount_refund;
        // var_dump($sumTotalAmount);
        if ($sumTotalAmount == "") {
            return 0;
        }else {
            return $sumTotalAmount;
        }

    }else {
        // $filler_start_date=date("d/m/Y", strtotime($start_date));
        // $filler_end_date=date("d/m/Y", strtotime($end_date));
        $sql_withdraw="SELECT SUM(credit) AS total_amount FROM withdraw WHERE status=0 AND `date_withdraw` between '".$start_date."' and '".$end_date."' ";
        $result_withdraw = $server->query($sql_withdraw);
        $row_withdraw = mysqli_fetch_assoc($result_withdraw);
        $total_amount_withdraw=$row_withdraw['total_amount'];

        $sql_deposit="SELECT SUM(amount) AS total_amount FROM refill WHERE `date_check` between '".$start_date."' AND '".$end_date."' and status = 1 and amount > 0";
        $result_deposit = $server->query($sql_deposit);
        $row_deposit = mysqli_fetch_assoc($result_deposit);
        $total_amount_deposit=$row_deposit['total_amount'];

        $sql_affliliate="SELECT SUM(credit) AS total_credit FROM history_affliliate WHERE `date_check` between '".$start_date."' AND '".$end_date."' and credit > 0";
        $result_affliliate = $server->query($sql_affliliate);
        $row_affliliate = mysqli_fetch_assoc($result_affliliate);
        $total_amount_affliliate=$row_affliliate['total_credit'];

        $sql_refund="SELECT SUM(credit) AS total_credit FROM history_refund WHERE `date_check` between '".$start_date."' AND '".$end_date."' and credit > 0";
        $result_refund = $server->query($sql_refund);
        $row_refund = mysqli_fetch_assoc($result_refund);
        $total_amount_refund=$row_refund['total_credit'];

        $sumTotalAmount = $total_amount_deposit-$total_amount_withdraw-$total_amount_affliliate-$total_amount_refund;
        
        if ($sumTotalAmount == "") {
            return 0;
        }else {
            return $sumTotalAmount;
        }

    }
}

function sumNetAmount($start_date,$end_date)
{
    include("../config/config.php");

    if ($start_date == "" && $end_date == "") {
        // $sql_withdraw="SELECT SUM(credit) AS total_amount FROM withdraw WHERE status=0  ";
        // $result_withdraw = $server->query($sql_withdraw);
        // $row_withdraw = mysqli_fetch_assoc($result_withdraw);
        // $total_amount_withdraw=$row_withdraw['total_amount'];

        // $sql_deposit="SELECT SUM(amount) AS total_amount FROM refill WHERE status = 1 and amount > 0";
        // $result_deposit = $server->query($sql_deposit);
        // $row_deposit = mysqli_fetch_assoc($result_deposit);
        // $total_amount_deposit=$row_deposit['total_amount'];

        $sql_promotion="SELECT SUM(credit) AS total_credit FROM history_promotion ";
        $result_promotion = $server->query($sql_promotion);
        $row_promotion = mysqli_fetch_assoc($result_promotion);
        $total_amount_promotion=$row_promotion['total_credit'];
        
        $sql_refund="SELECT SUM(credit) AS total_credit FROM history_refund ";
        $result_refund = $server->query($sql_refund);
        $row_refund = mysqli_fetch_assoc($result_refund);
        $total_amount_refund=$row_refund['total_credit'];

        $sql_affliliate="SELECT SUM(credit) AS total_credit FROM history_affliliate ";
        $result_affliliate = $server->query($sql_affliliate);
        $row_affliliate = mysqli_fetch_assoc($result_affliliate);
        $total_amount_affliliate=$row_affliliate['total_credit'];

        $sql_code_itme="SELECT SUM(credit) AS total_credit FROM code_itme WHERE status=1";
        $result_code_itme = $server->query($sql_code_itme);
        $row_code_itme = mysqli_fetch_assoc($result_code_itme);
        $total_amount_code_itme=$row_code_itme['total_credit'];


        $sumTotalAmount = $total_amount_promotion+$total_amount_refund+$total_amount_affliliate+$total_amount_code_itme;

        if ($sumTotalAmount == "") {
            return 0;
        }else {
            return $sumTotalAmount;
        }

    }else {
        // $filler_start_date=date("d/m/Y", strtotime($start_date));
        // $filler_end_date=date("d/m/Y", strtotime($end_date));
        // $sql_withdraw="SELECT SUM(credit) AS total_amount FROM withdraw WHERE status=0 AND `date_withdraw` between '".$start_date."' and '".$end_date."' ";
        // $result_withdraw = $server->query($sql_withdraw);
        // $row_withdraw = mysqli_fetch_assoc($result_withdraw);
        // $total_amount_withdraw=$row_withdraw['total_amount'];

        // $sql_deposit="SELECT SUM(amount) AS total_amount FROM refill WHERE `date_check` between '".$start_date."' AND '".$end_date."' and status = 1 and amount > 0";
        // $result_deposit = $server->query($sql_deposit);
        // $row_deposit = mysqli_fetch_assoc($result_deposit);
        // $total_amount_deposit=$row_deposit['total_amount'];



        $sql_promotion="SELECT SUM(credit) AS total_credit FROM history_promotion WHERE `date_withdraw` between '".$start_date."' and '".$end_date."'";
        $result_promotion = $server->query($sql_promotion);
        $row_promotion = mysqli_fetch_assoc($result_promotion);
        $total_amount_promotion=$row_promotion['total_credit'];
        
        $sql_refund="SELECT SUM(credit) AS total_credit FROM history_refund WHERE `date_withdraw` between '".$start_date."' and '".$end_date."'";
        $result_refund = $server->query($sql_refund);
        $row_refund = mysqli_fetch_assoc($result_refund);
        $total_amount_refund=$row_refund['total_credit'];

        $sql_affliliate="SELECT SUM(credit) AS total_credit FROM history_affliliate WHERE `date_withdraw` between '".$start_date."' and '".$end_date."'";
        $result_affliliate = $server->query($sql_affliliate);
        $row_affliliate = mysqli_fetch_assoc($result_affliliate);
        $total_amount_affliliate=$row_affliliate['total_credit'];

        $sql_code_itme="SELECT SUM(credit) AS total_credit FROM code_itme WHERE status=1 and WHERE `date_withdraw` between '".$start_date."' and '".$end_date."'";
        $result_code_itme = $server->query($sql_code_itme);
        $row_code_itme = mysqli_fetch_assoc($result_code_itme);
        $total_amount_code_itme=$row_code_itme['total_credit'];


        $sumTotalAmount = $total_amount_promotion+$total_amount_refund+$total_amount_affliliate+$total_amount_code_itme;
        
        if ($sumTotalAmount == "") {
            return 0;
        }else {
            return $sumTotalAmount;
        }

    }
}
// End function dashboard

// Start function reportdeposit

function depositList()
{
    include("../config/config.php");

    $sql="SELECT SUM(amount) AS total_amount FROM refill WHERE status = 1 and amount > 0";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function depositOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(amount) AS total_amount FROM refill WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y') and status = 1 and amount > 0";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function depositOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(amount) AS total_amount FROM refill WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y') and status = 1 and amount > 0";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function depositCusList()
{
    include("../config/config.php");

    $sql="SELECT COUNT(*) AS total_amount FROM refill WHERE status = 1 and amount > 0";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

// End function reportdeposit


// Start function reportwithdraw

function withdrawList()
{
    include("../config/config.php");
    $sql="SELECT SUM(credit) AS total_amount FROM withdraw ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function withdrawOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM withdraw WHERE DATE_FORMAT(STR_TO_DATE(date_withdraw, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function withdrawOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM withdraw WHERE DATE_FORMAT(STR_TO_DATE(date_withdraw, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function withdrawCusList()
{
    include("../config/config.php");

    $sql="SELECT COUNT(*) AS total_amount FROM withdraw";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

// End function reportwithdraw


// Start function reportbonus

function bonusList()
{
    include("../config/config.php");
    $sql="SELECT SUM(credit) AS total_amount FROM history_promotion ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function bonusOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_promotion WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function bonusOfWeekList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_promotion WHERE WEEKOFYEAR(STR_TO_DATE(date_check, '%d/%m/%Y'))=WEEKOFYEAR(NOW())";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function bonusOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_promotion WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

// End function reportbonus

// Start function reportrefun

function refunList()
{
    include("../config/config.php");
    $sql="SELECT SUM(credit) AS total_amount FROM history_refund ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function refunOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_refund WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function refunOfWeekList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_refund WHERE WEEKOFYEAR(STR_TO_DATE(date_check, '%d/%m/%Y'))=WEEKOFYEAR(NOW())";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function refunOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_refund WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

// End function reportrefun

// Start function reportgive

function giveList()
{
    include("../config/config.php");
    $sql="SELECT SUM(credit) AS total_amount FROM code_itme ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function giveOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM code_itme WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function giveOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM code_itme WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function giveCusList()
{
    include("../config/config.php");

    $sql="SELECT COUNT(*) AS total_amount FROM code_itme";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

// End function reportgive


// Start function reportwheel

function wheelList()
{
    include("../config/config.php");
    $sql="SELECT SUM(credit) AS total_amount FROM history_wheel ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function wheelOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_wheel WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function wheelOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_wheel WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function wheelCusList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount, SUM(bet) AS total_bet FROM history_wheel ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    $total_bet=$row['total_bet'];
    // echo $total_amount;
    $sum = $total_bet - $total_amount;
    if ($sum == "") {
        echo 0;
    }else {
        echo number_format($sum);
    }
}

// End function reportgive


// Start function reportaffliliate

function affliliateList()
{
    include("../config/config.php");
    $sql="SELECT SUM(credit) AS total_amount FROM history_affliliate ";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function affliliateOfMonthList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_affliliate WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y')=DATE_FORMAT(NOW(), '%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function affliliateOfWeekList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_affliliate WHERE WEEKOFYEAR(STR_TO_DATE(date_check, '%d/%m/%Y'))=WEEKOFYEAR(NOW())";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

function affliliateOfDayList()
{
    include("../config/config.php");

    $sql="SELECT SUM(credit) AS total_amount FROM history_affliliate WHERE DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%d/%m/%Y')=DATE_FORMAT(NOW(), '%d/%m/%Y')";
    $result = $server->query($sql);
    $row = mysqli_fetch_assoc($result);
    $total_amount=$row['total_amount'];
    // echo $total_amount;
    if ($total_amount == "") {
        echo 0;
    }else {
        echo number_format($total_amount);
    }
}

// End function reportaffliliate