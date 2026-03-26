  // 追加
  $(function(){
    // Ajaxリクエスト全てにCSRFトークンを付与
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    });

    $('.add_to_cart').on('click', function(e){
      
      e.preventDefault();
      
      let productId = $(this).data('id');
      
      $.ajax({
        type: "POST",
        url: "/cartItem/create/add",
        data: {
          product_id: productId
        },
        dataType:'json',
        success: function(data){
        
          total = data.total;
          data = data.cartItem;  
          
          $('#unit_price_' + data.product_id).text(data.unit_price + '円');
          $('#item_quantity_' + data.product_id).text(data.item_quantity);
          $('#sub_total').text(total.toLocaleString() + '円');
          $('#total').text((total.toLocaleString() + 0) + '円');
          
          if(data.item_quantity === 1){
            $('#remove_btn_' + productId).addClass('no_active');
          }else{
            $('#remove_btn_' + productId).removeClass('no_active');
          }
        },
        error: function(xhr){
          alert('エラーが発生しました');
        }
      });
    });

    $('.remove_to_cart').on('click', function(e){
      
      e.preventDefault();
      
      let productId = $(this).data('id');
      
      $.ajax({
        type: "POST",
        url: "/cartItem/create/remove",
        data: {
          product_id: productId
        },
        dataType:'json',
        success: function(data){
        
          total = data.total;
          data = data.cartItem;
          
          
          $('#unit_price_' + data.product_id).text(data.unit_price + '円');
          $('#item_quantity_' + data.product_id).text(data.item_quantity);
          $('#sub_total').text(total.toLocaleString() + '円');
          $('#total').text((total.toLocaleString()) + '円');


          if(data.item_quantity === 1){
            $('#remove_btn_' + productId).addClass('no_active');
            console.log(data.item_quantity);
            
          }else{
            $('#remove_btn_' + productId).removeClass('no_active');
          }
          
        },
        error: function(){
          alert('エラーが発生しました');
        }
      });
    });

    $('.bi-x').on('click', function(){
      let result =  window.confirm('カートから削除しますか？');
      if(result){
        let productId = $(this).data('id');
        let deleteBox = $(this).closest('.item_box');
        $.ajax({
          type: "POST",
          url: "/cartItem/delete",
          data: {
            product_id: productId
          },
          dataType:'json',
          success: function(data){
            console.log(data);
            
            deleteBox.remove();
            $('#sub_total').text(data.total.toLocaleString() + '円');
            $('#total').text((data.total.toLocaleString()) + '円');
            cartItemCount--;
            $('#cartItems_count').text(cartItemCount);
            console.log(cartItemCount);
            

            if (data.total === 0) {
              $('.order_btn').hide();
            } else {
              $('.order_btn').show();
            }
          },
          error: function(xhr, status, error){
            alert('エラーが発生しました');

          }
        });
      }
    });
  });