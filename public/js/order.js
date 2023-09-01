document.addEventListener("DOMContentLoaded", () => {
    let closeBtn = document.querySelector(".close");
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            let msg = document.querySelector(".msg");
            msg.style.display = 'none';
        });
    }
});
