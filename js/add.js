jQuery(document).ready(($) => {
    $('.quantity').on('click', '.plus', function(e) {
        let $input = $(this).prev('input.qty');
        let val = parseInt($input.val());
        $input.val( val+1 ).change();
        console.log(val+1);
    });
  
    $('.quantity').on('click', '.minus', function(e) {
        let $input = $(this).next('input.qty');
        var val = parseInt($input.val());
        if (val > 0) {
            $input.val( val-1 ).change();
            console.log(val-1);
        } 
    });
  });

  