document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    let isDarkMode = localStorage.getItem("darkMode") === "true";

    if (isDarkMode) {
        body.classList.add("dark-mode");
    }

    const darkModeButton = document.createElement("button");
    darkModeButton.innerHTML = isDarkMode ? "☀️" : "🌙"; // Default icon based on mode
    darkModeButton.onclick = toggleDarkMode;
    darkModeButton.style.position = "fixed";
    darkModeButton.style.bottom = "10px";
    darkModeButton.style.right = "10px";
    darkModeButton.style.zIndex = "1000";
    darkModeButton.style.padding = "10px 15px";
    darkModeButton.style.backgroundColor = "#444";
    darkModeButton.style.color = "#fff";
    darkModeButton.style.border = "none";
    darkModeButton.style.borderRadius = "50%";
    darkModeButton.style.cursor = "pointer";
    darkModeButton.style.fontSize = "20px";

    document.body.appendChild(darkModeButton);

    function toggleDarkMode() {
        if (isDarkMode) {
            body.classList.remove("dark-mode");
            localStorage.setItem("darkMode", "false"); // Save state
            darkModeButton.innerHTML = "🌙"; // Change icon to moon
        } else {
            body.classList.add("dark-mode");
            localStorage.setItem("darkMode", "true"); // Save state
            darkModeButton.innerHTML = "☀️"; // Change icon to sun
        }
        isDarkMode = !isDarkMode;
    }
});