<?php
class Checkout extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('order_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function index() {
    include_once('ecpay_sdk/ECPay.Payment.Integration.php');
    try {
    	$obj = new ECPay_AllInOne();
      //服務參數
      $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
      $obj->HashKey     = '5294y06JbISpM5x9' ;                                           //測試用Hashkey，請自行帶入ECPay提供的HashKey
      $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                           //測試用HashIV，請自行帶入ECPay提供的HashIV
      $obj->MerchantID  = '2000132';                                                     //測試用MerchantID，請自行帶入ECPay提供的MerchantID
      $obj->EncryptType = '1';                                                           //CheckMacValue加密類型，請固定填入1，使用SHA256加密


      //基本參數(請依系統規劃自行調整)
      $MerchantTradeNo = 'CB' . date('ymd') . rand(0, 9999);              //訂單序號格式 CB + 六碼年月日 + 四碼亂數
      $obj->Send['ReturnURL']         = base_url('checkout/receive') ;    //付款完成通知回傳的網址
      $obj->Send['OrderResultURL']    = base_url('checkout/receive') ;    //付款成功後的導向網址
      $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                 //訂單編號
      $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');              //交易時間
      $obj->Send['TotalAmount']       = $_SESSION['total_price'];         //交易金額
      $obj->Send['TradeDesc']         = "Coffee Beans House Online" ;     //交易描述
      $obj->Send['ChoosePayment']     = ECPay_PaymentMethod::Credit ;     //付款方式:Credit

      //訂單的商品資料
      foreach( $_SESSION['cart'] as $item ){
        array_push($obj->Send['Items'], array('Name' => $item['name'], 'Price' => (int)$item['price'],
                                      'Currency' => "元", 'Quantity' => (int)$item['quantity'], 'URL' => ""));
      }


      //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
      //以下參數不可以跟信用卡定期定額參數一起設定
      $obj->SendExtend['CreditInstallment'] = 0 ;    //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
      $obj->SendExtend['Redeem'] = false ;           //是否使用紅利折抵，預設false
      $obj->SendExtend['UnionPay'] = false;          //是否為聯營卡，預設false;

      //產生訂單(auto submit至ECPay)
      $obj->CheckOut();

    
    } catch (Exception $e) {
      // echo $e->getMessage();
      redirect( base_url('/'));
    } 
  }

  // 接收金流回傳資料，將訂單資料存進資料庫，並顯示 Thanks Page
  public function receive() {
    include_once('ecpay_sdk/ECPay.Payment.Integration.php');
    try {
        // 收到綠界科技的付款結果訊息，並判斷檢查碼是否相符
        $AL = new ECPay_AllInOne();
        $AL->MerchantID = '2000132';
        $AL->HashKey = '5294y06JbISpM5x9';
        $AL->HashIV = 'v77hoKGq4kWxNNIS';
        // $AL->encryptType = ECPay_EncryptType::ENC_MD5; // MD5
        $AL->EncryptType = ECPay_EncryptType::ENC_SHA256; // SHA256
        $AL->CheckOutFeedback();

        // 以付款結果訊息進行相對應的處理
        /** 
        回傳的綠界科技的付款結果訊息如下:
        Array
        (
            [MerchantID] =>
            [MerchantTradeNo] =>
            [StoreID] =>
            [RtnCode] =>
            [RtnMsg] =>
            [TradeNo] =>
            [TradeAmt] =>
            [PaymentDate] =>
            [PaymentType] =>
            [PaymentTypeChargeFee] =>
            [TradeDate] =>
            [SimulatePaid] =>
            [CustomField1] =>
            [CustomField2] =>
            [CustomField3] =>
            [CustomField4] =>
            [CheckMacValue] =>
        )
        */

        // 收到 ecpay 回傳訊息後，把訂單資料存進資料庫
        $res = $this->input->post();
        $sn = $res['MerchantTradeNo'];
        $total_price = $res['TradeAmt'];
        $buyer = $_SESSION['user_info']['buyer'];
        $address = $_SESSION['user_info']['address'];
        $tel = $_SESSION['user_info']['tel'];
        $email = $_SESSION['user_info']['email'];
        $pay_method = 'Credit';
        $has_paid = 1;
        $query_token = uniqid(rand());
        $cart = $_SESSION['cart'];
        $this->order_model->insert_order( $sn, $total_price, $buyer, $address, $tel, $email, $pay_method, $has_paid, $query_token, $cart );

        // 訂單新增後，將 session 清除，以避免汙染下一次的購物車
        $this->session->sess_destroy();

        $data['jsfile'] = 'thanks';
        $data['cssfile'] = 'thanks';
        $data['sn'] = $sn;
        // 顯示 thanks page
        $this->load->view('header', $data);
        $this->load->view('thanks', $data);
        $this->load->view('footer');


    } catch(Exception $e) {
        // echo '0|' . $e->getMessage();
        redirect( base_url('/'));
    }
  }
}