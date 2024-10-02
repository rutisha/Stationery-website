// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

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


// Dropdown
jQuery(document).ready(($) => {
    
  $('.drop').on('click',  function(e) {
      $('.dropdown-content').toggleClass('visible');
     });
  
  });

