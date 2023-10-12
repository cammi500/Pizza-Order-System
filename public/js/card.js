$(document).ready(function(){
    //when + button is clicked
    $('.btn-plus').click(function(){
       $parentNode =$(this).parents("tr");      
        $price =Number($parentNode.find('#price').text().replace("kyats",""));
       $qty = Number($parentNode.find('#qty').val());
       $total =$price * $qty;
       $parentNode.find('#total').html($total+"kyats");
        // summaryCalculation();
    $totalPrice = 0;
       $('#dataTable  tbody tr').each(function(index,row){
             $totalPrice += Number($(row).find('#total').text().replace("kyats", ""));
       });
      
       $('#subTotalPrice').html(`${$totalPrice} kyats`);
       $('#finalPrice').html(`${$totalPrice+3000}kyats`)
   
    })
})
$(document).ready(function(){
    //when - button is clicked
    $('.btn-minus').click(function(){
        $parentNode =$(this).parents("tr");
    //    $price = $parentNode.find('#price').val();
     $price =Number($parentNode.find('#price').text().replace("kyats",""));
       $qty = Number($parentNode.find('#qty').val())
       $total =$price * $qty;
       $parentNode.find("#total").html($total+"kyats")
       summaryCalculation();
    })
    //when cross button is clicked
    $('.btnRemove').click(function(){
        
        $parentNode = $(this).parents("tr");
        $productId = $parentNode.find("#productId").val();
        $orderId = $parentNode.find("#orderId").val();
        $.ajax({
            type : 'get',
            url : 'http://127.0.0.1:8000/user/ajax/clear/current/product',
             data : {'productId': $productId,'orderId': $orderId},
            dataType : 'json',
            
        })
        $parentNode.remove();
        summaryCalculation();
    })
    //calculate final price for order
    function summaryCalculation(){
        $totalPrice = 0;
       $('#dataTable tr').each(function(index,row){
             $totalPrice += Number($(row).find('#total').text().replace("kyats", ""));
       });
      
       $('#subTotalPrice').html(`${$totalPrice} kyats`);
       $('#finalPrice').html(`${$totalPrice+3000}kyats`);
       
    }
})