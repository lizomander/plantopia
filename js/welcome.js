document.addEventListener("DOMContentLoaded", () => {
    const welcomeMessageDiv = document.getElementById("welcome-message");

    const getGreetingMessage = () => {
        const hour = new Date().getHours();
        if (hour < 12) {
            return "Rise and shine! Bring some greenery into your life today!";
        } else if (hour < 18) {
            return "Brighten your day with a new plant buddy!";
        } else {
            return "Unwind with the beauty of nature. Discover your perfect plant!";
        }
    };

    welcomeMessageDiv.textContent = getGreetingMessage();
});