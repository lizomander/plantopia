document.addEventListener("DOMContentLoaded", () => {
    console.log("./javascript/shoppingCart.js loaded");

    // DOM elements
    const quantityInput = document.getElementById("quantity");
    const decreaseBtn = document.getElementById("decrease");
    const increaseBtn = document.getElementById("increase");
    const addToCollectionBtn = document.getElementById("add-to-collection-btn");
    const productQuantitySpan = document.getElementById("product-quantity");
    const listDiv = document.getElementById("list-div");

    const priceWithoutTaxInput = document.getElementById("priceWithoutTax");
    const priceWOTaxDisplay = document.getElementById("priceWOTaxDisplay");
    const priceWithTaxDisplay = document.getElementById("priceWithTaxDisplay");
    const totalPriceWithTaxDisplay = document.getElementById("total-price-with-tax");
    const calculatePriceBtn = document.getElementById("calculatePriceBtn");

    // Tax rate
    const taxRate = 0.2;

    // Increase quantity
    increaseBtn.addEventListener("click", () => {
        console.log("Increase button clicked");
        const currentValue = parseInt(quantityInput.value, 10) || 1;
        console.log("Current quantity (before):", currentValue);
        quantityInput.value = currentValue + 1;
        console.log("Updated quantity:", quantityInput.value);
    });

    // Decrease quantity
    decreaseBtn.addEventListener("click", () => {
        console.log("Decrease button clicked");
        const currentValue = parseInt(quantityInput.value, 10) || 1;
        console.log("Current quantity (before):", currentValue);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            console.log("Updated quantity:", quantityInput.value);
        }
    });

    // Add to collection
    addToCollectionBtn.addEventListener("click", () => {
        const quantity = parseInt(quantityInput.value, 10);
        console.log("Adding to collection. Quantity:", quantity);
        productQuantitySpan.textContent = quantity;
        listDiv.classList.remove("hidden");
    });

    // Calculate price with tax
    calculatePriceBtn.addEventListener("click", () => {
        const priceWithoutTax = parseFloat(priceWithoutTaxInput.value) || 0;
        const priceWithTax = (priceWithoutTax * (1 + taxRate)).toFixed(2);
        console.log("Price without tax:", priceWithoutTax);
        console.log("Price with tax:", priceWithTax);

        priceWOTaxDisplay.textContent = priceWithoutTax.toFixed(2);
        priceWithTaxDisplay.textContent = priceWithTax;

        // Calculate total price with tax
        const quantity = parseInt(quantityInput.value, 10) || 1;
        const totalPriceWithTax = (priceWithTax * quantity).toFixed(2);
        console.log("Total price with tax:", totalPriceWithTax);
        totalPriceWithTaxDisplay.textContent = totalPriceWithTax;
    });
});