/*===== HIDE & UNHIDE PASSWORD =====*/
/* Sign Up Password */
const eyesSignUp = document.getElementById('eyes__signup');
eyesSignUp.addEventListener('click', () => {
   var y = document.getElementById('user__password1');
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

/* Sign Up Confirm Password */
const eyesSignUp1 = document.getElementById('eyes__signup1');
eyesSignUp1.addEventListener('click', () => {
   var z = document.getElementById('user__cpassword');
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
