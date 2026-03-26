document.addEventListener("DOMContentLoaded", () => {
  const openBtn = document.getElementById("open_register");
  const modal = document.getElementById("register_modal");
  const closeBtn = modal.querySelector(".close");

  // 開く
  openBtn.addEventListener("click", (e) => {
    e.preventDefault();
    modal.style.display = "flex"; // flexで中央寄せ
  });

  // 閉じる（×ボタン）
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  // 背景クリックでも閉じる
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });
});
