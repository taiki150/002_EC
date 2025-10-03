document.addEventListener("DOMContentLoaded", () => {
  const openButtons = document.querySelectorAll(".open-modal");
  const closeButtons = document.querySelectorAll(".close");

  // 開く
  openButtons.forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = btn.getAttribute("data-id");
      document.getElementById("modal-" + targetId).style.display = "block";
    });
  });

  // 閉じる（×ボタン）
  closeButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      btn.closest(".modal").style.display = "none";
    });
  });

  // 背景クリックでも閉じる
  window.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal")) {
      e.target.style.display = "none";
    }
  });
});

/**********************************************************
*
* ここからAjax処理
*
**********************************************************/



$(function(){

  // Ajaxリクエスト全てにCSRFトークンを付与
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  });
  
  // 新規作成
  $('.create_to_cart').on('click', function(e){
    e.preventDefault();
    
    let productId = $(this).data('id');

    $.ajax({
      type: "POST",
      url: "/cartItem/create",
      data: {
        product_id: productId
      },
      success: function(data){
        $('#cartItems_count').text(data.count).addClass('bump');

        setTimeout(function() {
          $('#cartItems_count').removeClass('bump');
        }, 300);
      },
      error: function(xhr){
        alert('エラーが発生しました');
      }
    });
  });

  // 追加
  $('.add_to_cart').on('click', function(e){
    e.preventDefault();
    
    let productId = $(this).data('id');

    $.ajax({
      type: "POST",
      url: "/cartItem/create/add",
      data: {
        product_id: productId
      },
      success: function(data){
        $('#cartItems_count').text(data.count).addClass('bump');

        setTimeout(function() {
          $('#cartItems_count').removeClass('bump');
        }, 300);
        
      },
      error: function(xhr){
        alert('エラーが発生しました');
      }
    });
  });

});
