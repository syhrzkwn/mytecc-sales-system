/*===== HIDE & UNHIDE PASSWORD ON RESET PASSWORD PAGE =====*/
/* Password */
const eyesSignUp = document.getElementById('eyes__signup2');
eyesSignUp.addEventListener('click', () => {
   var y = document.getElementById('user__password2');
   if (y.type === 'password') {
      y.type = 'text';
      document.getElementById('eye__show-icon1').style.display = "block";
      document.getElementById('eye__hide-icon1').style.display = "none";
   }
   else {
      y.type = 'password';
      document.getElementById('eye__show-icon1').style.display = "none";
      document.getElementById('eye__hide-icon1').style.display = "block";
   }
})

/* Confirm Password */
const eyesSignUp1 = document.getElementById('eyes__signup3');
eyesSignUp1.addEventListener('click', () => {
   var z = document.getElementById('user__cpassword1');
   if (z.type === 'password') {
      z.type = 'text';
      document.getElementById('eye__show-icon2').style.display = "block";
      document.getElementById('eye__hide-icon2').style.display = "none";
   }
   else {
      z.type = 'password';
      document.getElementById('eye__show-icon2').style.display = "none";
      document.getElementById('eye__hide-icon2').style.display = "block";
   }
})