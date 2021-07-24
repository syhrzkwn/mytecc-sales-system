/*===== HIDE & UNHIDE PASSWORD =====*/
/* Log In Password */
const eyesLogin = document.getElementById('eyes__login');
eyesLogin.addEventListener('click', () => {
   var x = document.getElementById('user__password');
   if (x.type === 'password') {
      x.type = 'text';
      document.getElementById('eye__show-icon').style.display = "block";
      document.getElementById('eye__hide-icon').style.display = "none";
   }
   else {
      x.type = 'password';
      document.getElementById('eye__show-icon').style.display = "none";
      document.getElementById('eye__hide-icon').style.display = "block";
   }
})