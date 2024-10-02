let signup = document.querySelector(".signup");
let login = document.querySelector(".login");
let slider = document.querySelector(".slider");
let formSection = document.querySelector(".form-section");

signup.addEventListener("click", () => {
	slider.classList.add("moveslider");
	formSection.classList.add("form-section-move");
});

login.addEventListener("click", () => {
	slider.classList.remove("moveslider");
	formSection.classList.remove("form-section-move");
});
/* View More*/
$( document ).ready(function () {
	$(".morebox").slice(0, 3).show();
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