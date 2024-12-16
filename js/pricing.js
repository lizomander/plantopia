// Function to calculate total price with 19% tax
function getTotalPrice(priceWOTax) {
    const taxRate = 0.19;
    return priceWOTax + priceWOTax * taxRate;
}

document.addEventListener("DOMContentLoaded", () => {
    const priceWithoutTaxInput = document.getElementById("priceWithoutTax");
    const calculatePriceBtn = document.getElementById("calculatePriceBtn");
    const priceWOTaxDisplay = document.getElementById("priceWOTaxDisplay");
    const priceWithTaxDisplay = document.getElementById("priceWithTaxDisplay");

    // Calculate and display prices
    calculatePriceBtn.addEventListener("click", () => {
        const priceWOTax = parseFloat(priceWithoutTaxInput.value);
        if (isNaN(priceWOTax) || priceWOTax < 0) {
            alert("Please enter a valid positive number for the price.");
            return;
        }
        const priceWithTax = getTotalPrice(priceWOTax);

        // Update the displayed prices
        priceWOTaxDisplay.textContent = priceWOTax.toFixed(2);
        priceWithTaxDisplay.textContent = priceWithTax.toFixed(2);
    });

});