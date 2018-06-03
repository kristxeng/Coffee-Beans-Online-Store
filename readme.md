# 咖啡豆商城 Demo  
[http://thinkr.tw/coffee-beans](http://thinkr.tw/coffee-beans)  
- 此為 [Lidemy Mentor Program](https://github.com/Lidemy/mentor-program-kristxeng) 的 Final Project
- 後端使用 PHP 框架 CodeIgniter + MySQL  
- 前端 HTML + CSS + JavaScript(jQuery)  
- thinkr.tw 主機運行在 Amazon Web Service (aws) EC2 的 Ubuntu 16.04  

## API串接  
**金流串接：**  
串接了「綠界科技 ECPay」測試環境的信用卡付款功能，測試下單請用以下資料  

>卡號：4311-9522-2222-2222  
>  
>有效月年：請輸入大於現在當下時間的月年即可  
>  
>安全碼：222  
>  
>＊ 因為會傳簡訊做 OTP 簡訊驗証，行動電話請填你的真實號碼，謝謝  

結帳步驟：  
1. 填寫購物車下方收件人資料，並按下結帳按鍵後，收件人資料暫存在 session 中，並轉跳至綠界的信用卡結帳介面。  
2. 結帳的信用卡資料請使用上述測試信用卡，手機號碼請填可收到簡訊的號碼。
3. 按下「確定」後，會先顯示此為測試環境的提示對話框，再按一次「確定」後才會進行 OTP 簡訊驗證。
4. 通過 OTP 簡訊驗證後，網頁將從綠界的結帳介面轉跳回 Coffee Beans House 的 Thanks Page。  
  
**Google Map API 串接**  
- 在首頁 footer 顯示的 Google Map，串接 Google Map JavaScript API，建立一個含標記的動態地圖。  
- 在 Google API Console 中，已限制該筆金鑰的 http 參照網址，以防止金鑰被竊取使用。  


## 購物車  
- 使用 session 機制暫存，預設 2 小時過期。
- Client 端僅上傳 product id，商品的其他資料會在第一次加入購物車的時候，從資料庫裏面查詢，以避免價格等資訊被 Client 端竄改的可能性。  
- 購物車內的商品數量修改及刪除，使用 AJAX 將存在該筆商品的自訂參數 `data-key` 及 quantity 數值 POST 至後端修改 session。
- 在訂單成立，相關資訊轉存進資料庫後，會將購物車 session destroy，已避免汙染下次的購物車內容。  

## 管理後台  
>[http://thinkr.tw/coffee-beans/admin](http://thinkr.tw/coffee-beans/admin)  
>帳號密碼： admin / admin  
- 管理者密碼使用 password_hash() 加密儲存在資料庫。  

**商品管理：**  
- 商品圖片規格限制： 1MB / 1000x1000px  
- 在新增或修改商品時，如果沒有指定圖片檔案，會使用 `e.preventDefault()` 略過要上傳檔案的 form，而使用 AJAX POST 文字資料至後端。
- 新增商品時沒指定檔案時，會使用預設的圖片。

**訂單管理：**  
- 訂單依照「已付款但未出貨」、「未付款」、「已付款已出貨」分為三類。
- 已付款的訂單，可修改已出貨/未出貨的標記。

**設定精選商品：**
- 在上架商品中挑選三支，展示在首頁下方空間。
