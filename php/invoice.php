<?php
session_start();
  
$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once 'usersFunction.php';

//TO GENERATE INVOICE NUMBER
require_once '../includes/connection.inc.php';
$sql = "SELECT orderCode FROM orders ORDER BY orderCode DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$lastid = $row['orderCode'];

if(empty($lastid)) {
  $number = "#00001";
}
else {
  $idd = str_replace("#","",$lastid);
  $id = str_pad($idd + 1,5,0,STR_PAD_LEFT);
  $number = '#' .$id;
}

$res = getUsersContactDetails();
if ($res == null) {
  header("Location: basket?alertupdateaccount");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0" />

    <!-- ===== LINE AWESOME ICONS ===== -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"/>

    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    
    <!-- ===== MAIN CSS FOR INVOICE ===== -->
    <link rel="stylesheet" href="../assets/css/basket.css" />
    <link rel="stylesheet" href="../assets/css/invoice.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Invoice</title>
  </head>
  <body>
    <input type="checkbox" id="nav-toggle" />
    
    <!-- ===== SIDEBAR ===== -->
    <?php require_once 'sideBar.php'; ?>

    <div class="main-content">
      
      <!-- ===== HEADER ===== -->
      <?php headerBar('Invoice'); ?> 

      <main>
        <!-- ===== INVOICE ===== -->
        <section style="margin-top:1rem;">
          <h2 class="section-title">
            <span style="color: #ff1111;">BASKET <i class='bx bxs-right-arrow'></i> INVOICE <i class='bx bxs-right-arrow'></i></span> PAYMENT
          </h2>
        </section>
        <form action="../includes/orders.inc.php" method="post" id="printJS-form">
          <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
              <tr class="top">
                <td colspan="2">
                  <table>
                    <tr>
                      <td class="title">
                        <img src="../assets/img/logo MYTECC (white outline).png" style="width: 100%; max-width: 7rem;" />
                      </td>

                      <td>
                        <?php
                        date_default_timezone_set('Asia/Kuala_Lumpur');
                        $date = date("Y-m-d");
                        $time = date("h:i:s");
                        ?>
                        <strong><label>Invoice : </label><input type="text" name="invoiceid" value="<?php echo $number?>" id="invoiceid" readonly="readonly" style="width: 65px;border:none;outline:none;font-weight:600;font-size:1rem;color:#ff1111;"></strong><br />
                        <label>Created : </label><input type="text" name="date" value="<?php echo $date?>" readonly="readonly" style="width: 90px;border:none;outline:none;font-size:1rem;"></input><br>
                        <label>Time : </label><input type="text" name="time" value="<?php echo $time?>" readonly="readonly" style="width: 90px;border:none;outline:none;font-size:1rem;"></input>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <tr class="information">
                <td colspan="2">
                  <table>
                    <tr>
                      <td>
                        MARA Youth Technology Computer Club (MYTECC)<br>
                        myteccraub@gmail.com<br>
                        Universiti Teknologi Mara (UiTM),<br>
                        Cawangan Pahang Kampus Raub,<br>
                        Felda Krau, 27600 Raub, Pahang.
                      </td>

                      <td>
                        <?php
                        $result = getUsersAccountDetails();
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo'<span>'.$row['usersName'].'</span><br/>';
                          echo'<span>'.$row['usersEmail'].'</span><br/>';

                          $result1 = getUsersContactDetails();
                          while ($row = mysqli_fetch_assoc($result1)) {
                          echo'<span>'.$row['address'].',</span><br/>';
                          echo'<span>'.$row['postcode'].', '.$row['city'].', '.$row['stateName'].'.</span><br/>';
                          echo'<span>'.$row['phoneNum'].'</span>';
                          }
                        }

                        ?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <tr class="heading">
                <td>Item(s)</td>

                <td>Price</td>
              </tr>

              <?php
              $total = 0;
              if(!empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $keys => $value) {
                  echo'<tr class="item">';
                  echo'<td>'.$value['productName'].' - '.$value['size'].' - '.$value['price'].' x '.$value['quantity'].'</td>';
                  echo'<td>RM'.number_format($value['price'] * $value['quantity'],2).'</td>';
                  echo'</tr>';
                  $total = $total + ($value['price'] * $value['quantity']);
                  echo '<input type="hidden" name="size[]" value="'.$value['size'].'">';
                  echo '<input type="hidden" name="quantity[]" value="'.$value['quantity'].'">';
                  echo '<input type="hidden" name="product[]" value="'.$value['productCode'].'">';
                }
              }
              ?>

              <input type="hidden" name="total" value="<?php echo ($total+5)?>">

              <tr class="item">
                <td>Delivery Fee</td>
                
                <td>RM5.00</td>
              </tr>

              <tr>
                <td></td>
                <td><strong>Total: RM<?php echo number_format(($total+5),2);?></strong></td>
              </tr>
              <tr>
                <td><small style="color: #555;">Terms & Conditions Apply.</small></td>
              </tr>
            </table>
          </div>
          <div style="text-align: center; margin-top: 3rem;">
            <button type="button" onclick="printJS('printJS-form', 'html')" class="inv-btn"><i class='bx bx-printer' class="bx bx-credit-card-front" style="vertical-align: middle; margin-right: .5rem;"></i>Print Invoice</button>
            <br>
            <button type=submit name="pay" class="inv-btn"><i class="bx bx-credit-card-front" style="vertical-align: middle; margin-right: .5rem;"></i>Pay Now</button>
          </div>
        </form>
      </main>
    </div>

    <!-- ===== JQUERY CDN ===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- ===== WHATSAPP WIDGET ===== -->
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-cb77e803-0fac-46dc-ab86-1d1dfd9b488c"></div>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <!-- ===== MAIN JS ===== -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>