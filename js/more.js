/* View More*/
$( document ).ready(function () {  
    $(".morebox").slice(0, 9).show();  
    if ($(".probox:hidden").length != 0) {  
        $("#loadmore").show();  
    }         
    $("#loadmore").on('click', function (e) {  
        e.preventDefault();  
        $(".morebox:hidden").slice(0, 6).slideDown();  
        if ($(".morebox:hidden").length == 0) {  
            $("#loadmore").fadeOut('slow');  
        }  
    });  
});  

/* Dropdown categories */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}


