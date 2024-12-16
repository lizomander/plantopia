document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    // DARK MODE TOGGLE
    let isDarkMode = localStorage.getItem("darkMode") === "true";

    if (isDarkMode) {
        body.classList.add("dark-mode");
    }

    const darkModeButton = document.createElement("button");
    darkModeButton.innerHTML = isDarkMode ? "☀️" : "🌙";
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
            localStorage.setItem("darkMode", "false"); 
            darkModeButton.innerHTML = "🌙";
        } else {
            body.classList.add("dark-mode");
            localStorage.setItem("darkMode", "true");
            darkModeButton.innerHTML = "☀️";
        }
        isDarkMode = !isDarkMode;
    }

    // LAYOUT TOGGLE
    let isMobileLayout = false;

    const layoutToggleButton = document.createElement("button");
    layoutToggleButton.innerHTML = "📱"; 
    layoutToggleButton.onclick = toggleLayout;
    layoutToggleButton.style.position = "fixed";
    layoutToggleButton.style.bottom = "60px"; 
    layoutToggleButton.style.right = "10px";
    layoutToggleButton.style.zIndex = "1000";
    layoutToggleButton.style.padding = "10px 15px";
    layoutToggleButton.style.backgroundColor = "#444";
    layoutToggleButton.style.color = "#fff";
    layoutToggleButton.style.border = "none";
    layoutToggleButton.style.borderRadius = "50%";
    layoutToggleButton.style.cursor = "pointer";
    layoutToggleButton.style.fontSize = "20px";

    document.body.appendChild(layoutToggleButton);

    function toggleLayout() {
        console.log("Toggling layout...");
        if (isMobileLayout) {
            body.classList.remove("mobile-layout");
            layoutToggleButton.innerHTML = "📱";
        } else {
            body.classList.add("mobile-layout");
            layoutToggleButton.innerHTML = "🖥️";
        }
        isMobileLayout = !isMobileLayout;
    }

    // DROPDOWN TOGGLE LOGIC
    const navItems = document.querySelectorAll("nav ul li");

    navItems.forEach((item) => {
        const dropdown = item.querySelector("ul");
        if (dropdown) {
            item.addEventListener("mouseenter", () => {
                if (!body.classList.contains("mobile-layout")) {
                    dropdown.style.display = "block";
                }
            });

            item.addEventListener("mouseleave", () => {
                if (!body.classList.contains("mobile-layout")) {
                    dropdown.style.display = "none"; 
                }
            });

            item.addEventListener("click", (e) => {
                if (body.classList.contains("mobile-layout")) {
                    e.preventDefault(); 
                    dropdown.style.display =
                        dropdown.style.display === "block" ? "none" : "block"; 
                }
            });
        }
    });
});