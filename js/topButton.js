document.addEventListener("DOMContentLoaded", function () {
    const topButton = document.getElementById("back-to-top");

    window.onscroll = function () {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            topButton.style.display = "block";
        } else {
            topButton.style.display = "none";
        }
    };

    topButton.onclick = function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    };
});