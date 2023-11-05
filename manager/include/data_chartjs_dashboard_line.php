<?php
    header("Content-type: application/json; charset=utf-8");
    include("../../config/config.php");

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $filler_start_date=date("d/m/Y", strtotime($start_date));
    $filler_end_date=date("d/m/Y", strtotime($end_date));
    if ($start_date == "" && $end_date == "") {

        $sql="SELECT *, SUM(amount) AS total_amount, DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y') as getMonth FROM refill GROUP BY getMonth";
        $result = $server->query($sql);
        $data = array();
        while($row=mysqli_fetch_array($result)){
            
            $date_check = $row['date_check'];
            // print($date_check);
            $sql_withdraw="SELECT *, SUM(credit) AS total_credit FROM withdraw WHERE status=0 AND date_withdraw = '".$date_check."'  GROUP BY date_withdraw";
            $result_withdraw = $server->query($sql_withdraw);
            $row_withdraw = mysqli_fetch_assoc($result_withdraw);
            $total_amount_withdraw=$row_withdraw['total_credit'];

            if ($row_withdraw['date_withdraw'] == "") {
                $data_withdraw = $row['total_amount'];
                // print("NULL <br>");
            }else {
                $data_withdraw = $row['total_amount'] - $row_withdraw['total_credit'];
                // print("FOUND <br>");
            }

            $data['data'][] = intval($data_withdraw);
            $data['label'][] = $row['getMonth'];
        }

        echo json_encode($data);


    }else {
        $sql="SELECT *, SUM(amount) AS total_amount, DATE_FORMAT(STR_TO_DATE(date_check, '%d/%m/%Y'), '%m/%Y') as getMonth FROM refill WHERE `date_check` between '".$start_date."' and '".$end_date."' GROUP BY getMonth";
        $result = $server->query($sql);
        $data = array();
        while($row=mysqli_fetch_array($result)){
            
            $date_check = $row['date_check'];
            // print($date_check);
            $sql_withdraw="SELECT *, SUM(credit) AS total_credit FROM withdraw WHERE status=0 AND date_withdraw = '".$date_check."' AND `date_withdraw` between '".$start_date."' and '".$end_date."'  GROUP BY date_withdraw";
            $result_withdraw = $server->query($sql_withdraw);
            $row_withdraw = mysqli_fetch_assoc($result_withdraw);
            $total_amount_withdraw=$row_withdraw['total_credit'];

            if ($row_withdraw['date_withdraw'] == "") {
                $data_withdraw = $row['total_amount'];
                // print("NULL <br>");
            }else {
                $data_withdraw = $row['total_amount'] - $row_withdraw['total_credit'];
                // print("FOUND <br>");
            }

            $data['data'][] = intval($data_withdraw);
            $data['label'][] = $row['getMonth'];
        }

        echo json_encode($data);

    }

    // SELECT a.date_check, SUM(IFNULL(a.amount, 0)) -
    // IFNULL((SELECT SUM(IFNULL(b.credit, 0)) FROM withdraw b WHERE a.date_check = b.date_withdraw GROUP BY a.date_check), 0)
    // FROM refill a
    // GROUP BY a.date_check
?>