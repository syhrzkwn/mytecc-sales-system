<?php
session_start();
  
$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once '../includes/connection.inc.php';
require_once '../includes/ordersFunction.inc.php';

$orderCode = $_POST['invoice'];

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
    <title>MYTECC | Invoice <?php echo $orderCode?></title>
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
        <?php
        $result = getInvoiceUsersDetails($conn,$orderCode);
        while($row = mysqli_fetch_assoc($result)) {
          ?>
          <form action="" method="post" id="printJS-form">
            <div class="invoice-box" style="margin-top:2rem;">
              <table cellpadding="0" cellspacing="0">
                <tr class="top">
                  <td colspan="2">
                    <table>
                      <tr>
                        <td class="title">
                          <img src="../assets/img/logo MYTECC (white outline).png" style="width: 100%; max-width: 7rem;" />
                        </td>

                        <td>
                          <strong>
                            <label>Invoice : <?php echo $row['orderCode']?><br>
                            <label>Created : <?php echo $row['orderDate']?></label><br>
                            <label>Time : <?php echo $row['orderTime']?></label>
                          </strong>
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
                          <span><?php echo $row['usersName']?></span><br/>
                          <span><?php echo $row['usersEmail']?></span><br/>

                          <span><?php echo $row['address']?>,</span><br/>
                          <span><?php echo $row['postcode']?>, <?php echo $row['city']?>, <?php echo $row['stateName']?>.</span><br/>
                          <span><?php echo $row['phoneNum']?></span>
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
                $result1 = getInvoiceOrderDetails($conn,$orderCode);
                while($row1 = mysqli_fetch_assoc($result1)) {
                  ?>
                  <tr class="item">
                    <td><?php echo $row1['productName']?> - <?php echo $row1['size']?> - RM<?php echo $row1['price']?> x <?php echo $row1['quantity']?></td>
                    <td>RM<?php echo number_format($row1['price'] * $row1['quantity'],2)?></td>
                  </tr>
                <?php
                }
                ?>

                <tr class="item">
                  <td>Delivery Fee</td>
                        
                  <td>RM5.00</td>
                </tr>

                <tr>
                  <td></td>
                        
                  <td><strong>Total: RM<?php echo $row['orderPrice']?></strong></td>
                </tr>
                <tr>
                  <td><small style="color: #555;">Terms & Conditions Apply.</small></td>
                </tr>
              </table>
            </div>
            <div style="text-align: center; margin-top: 3rem;">
              <button type="button" onclick="printJS('printJS-form', 'html')" class="inv-btn"><i class="bx bx-printer" class="bx bx-credit-card-front" style="vertical-align: middle; margin-right: .5rem;"></i>Print Invoice</button>
            </div>
          </form>
        <?php }?>
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