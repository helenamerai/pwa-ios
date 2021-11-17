<?php

require 'Encryption.php';
require 'SarawakPay.php';

use plugins\Encryption;
use plugins\SarawakPay;
header('Content-Type: text/plain');


// header('Content-Type: text/plain');
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST, PUT');
// header('Access-Control-Allow-Headers: X-Custom-Header');

function display()
{
    // if(isset($_POST)){
    //     echo "hello ".$_POST['studentname'];
    //     }
        $data = [
    "merchantId"        => "M100002380", // To be replace by integration merchant ID
    "curType"           => "RM",
    "notifyURL"         => 'https://www.google.com/',
    "merOrderNo"        => 'POS-123916929',
    "goodsName"         => "Twisties Special Pack",
    "orderAmt"          => "1",
    "remark"            => "Special Promotional Pack",
    "detailURL"         => "https://www.youtube.com/",
    "transactionType"   => "1",
];

$result = SarawakPay::post('https://spfintech.sains.com.my/xservice/H5PaymentAction.preOrder.do', $data);

echo $result;
    }

// class CreateOrder
// {
  
//     public static function first($int, $string){ //function parameters, two variables.
//         echo "COME HERE";
//         echo "COME HERE xxxxxxxxxxxxxxxxxxxx";
//         return $string;  //returns the second argument passed into the function
//       }
// }


// $merchantId = $_POST['merchantId'];
// $curType = $_POST['curType'];
// $notifyURL = $_POST['notifyURL'];
// $merOrderNo = $_POST['merOrderNo'];
// $orderAmt = $_POST['orderAmt'];
// $goodsName = $_POST['goodsName'];
// $transactionType = $_POST['transactionType'];
// $remark = $_POST['remark'];

// $data = [
//     "merchantId"        => "M100002380", // To be replace by integration merchant ID
//     "curType"           => "RM",
//     "notifyURL"         => 'https://www.google.com/',
//     "merOrderNo"        => 'POS-123916929',
//     "goodsName"         => "Twisties Special Pack",
//     "orderAmt"          => "1",
//     "remark"            => "Special Promotional Pack",
//     "detailURL"         => "https://www.youtube.com/",
//     "transactionType"   => "1",
// ];

// $result = SarawakPay::post('https://spfintech.sains.com.my/xservice/H5PaymentAction.preOrder.do', $data);

// echo $result;
?>
