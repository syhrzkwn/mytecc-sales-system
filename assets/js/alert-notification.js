//close alerts notification
var alert_items = document.querySelectorAll(".alert_item");
var alert_wrapper = document.querySelector(".alert_wrapper");
var close_btns = document.querySelectorAll(".close");

close_btns.forEach(function(close, close_index){
  close.addEventListener("click", function(){
    alert_wrapper.classList.remove("active1");

    alert_items.forEach(function(alert_item, alert_index){
      alert_item.style.top = "-100%";
    })
  })
})