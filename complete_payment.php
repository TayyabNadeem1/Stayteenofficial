<?php  

session_start();

include('connection.php');

//change order status to paid

    if(isset($_GET['transaction_id']) && isset($_GET['order_id'])) {

        $order_id = $_GET['order_id'];
        $order_status = "paid";
        $transaction_id = $_GET['transaction_id'];
        // $user_id = 1;

        $stmt = $conn->prepare("update orders set order_status=? where order_id=?");
        $stmt->bind_para('si',$order_status,$order_id);
        
        $stmt->execute();

        //store payment info to database
        $stmt1 =  $conn->prepare("insert into payments (order_cid, user_id, transaction_id,customer_name)
        values (?,?,?,?); ");

        $stmt1->bind_param('iiis',$order_id,$user_id, $transaction ,$name);

                
        $stmt1->execute();


        //

        header("location : index.php? payment_message=paid successfully. Thanks for trusting us");

}else{
    header("location : index.php");
    exit();
}
?>

