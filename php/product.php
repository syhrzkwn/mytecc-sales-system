<?php

function product($productName, $productPrice, $productImg, $productDisc, $productCode, $normalPrice) {
  $element = '
  
  <form class="product" action="shop" method="post">
    <div class="product__sale">Sale</div>

    <img src="'.$productImg.'" alt="" class="product__img" />
    <span class="product__name" style="text-align:center;">'.$productName.'</span>
    <small style="font-weight:500;"><s>RM'.$normalPrice.'</s></small>
    <span class="product__price">RM'.$productPrice.'</span>

    <div style="margin-bottom:.5rem;">
      <label><strong>Size : </strong>
        <select name="size" style="border:2px solid gray; outline:none; border-radius:5px;">
          <option value="XS">XS</option>
          <option value="S">S</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>
          <option value="STD">Standard</option>
        </select>
      </label>
    </div>

    <div style="margin-bottom:1rem;">
      <label><strong>Qty : </strong>
        <input type="number" name="quantity" min="1" value="1" style="width:88px; border:2px solid gray; outline:none; border-radius:5px; text-align:center;"></input>
      </label>
    </div>

    <button type="submit" name="add" class="button-light">Add to basket <i class="bx bx-basket button-icon"></i></button>
    <input type="hidden" name="productCode" value="'.$productCode.'">
    <input type="hidden" name="productImg" value="'.$productImg.'">
    <input type="hidden" name="productName" value="'.$productName.'">
    <input type="hidden" name="productDisc" value="'.$productDisc.'">
    <input type="hidden" name="price" value="'.$productPrice.'">
  </form>

  ';
  echo $element;
}

//get product from the database
function getProduct() {
  require_once '../includes/connection.inc.php';

  $sql = "SELECT * FROM product";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    return $result;
  }
}

function cartElement($productImg, $productName, $productDisc, $price, $productCode,$size,$quantity) {
  $element = '
  
  <form action="basket?&action=remove&id='.$productCode.'" method="post" class="product_wrap">
    <div class="product_info">
      <div class="product_img">
        <img src="'.$productImg.'" alt="ProductImage">
      </div>

      <div class="product_data">
        <div class="description">
          <div class="main_header">
            '.$productName.'
          </div>
          <div class="sub_header">
            Product Description:<br>
            '.$productDisc.'
          </div>
        </div>

        <div class="qty">
          <div>
            <p>Size : '.$size.'</p>
          </div>
          <div>
            <p>Quantity : '.$quantity.'</p>
          </div>
        </div>

        <div class="price">
          <div class="current_price">RM'.$price.'</div>
        </div>
      </div>
    </div>

    <div class="product_btns">
      <button type="submit" name="remove" class="remove"><i class="bx bx-trash"></i> REMOVE</button>
      <!--<button type="submit" name="save" class="wishlist"><i class="bx bxs-heart"></i> MOVE TO WISHLIST</button>-->
    </div>  
  </form>
  ';
  
  echo $element;
}
