const listDiv = document.getElementById("list-div");
const productQuantity = document.getElementById("quantity");
const productQuantityP = document.getElementById("product-quantity");
const increase = document.getElementById("increase");

const decrease = document.getElementById("decrease");

increase.addEventListener("click", (e) => {
  let currentQuantity = parseInt(productQuantity.value);
  productQuantity.value = currentQuantity + 1;
});
decrease.addEventListener("click", () => {
  let currentQuantity = parseInt(productQuantity.value);
  productQuantity.value = currentQuantity - 1;
});

document
  .getElementById("add-to-collection-btn")
  .addEventListener("click", function (e) {
    listDiv.classList.add("show");
    productQuantityP.textContent = productQuantity.value;
  });