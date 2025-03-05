document.querySelectorAll(".open-popup").forEach(button => {
    button.addEventListener("click", function() {
        fetch("check_login.php")
            .then(response => response.text())
            .then(data => {
                if (data === "not_logged_in") {
                    alert("Please login to add items to cart!");
                } else {
                    let productId = this.getAttribute("data-id");

                    fetch(`get_product.php?id=${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("product-id").value = data.id;
                            document.getElementById("product-name").innerText = data.name;
                            document.getElementById("product-price").innerText = "₹ " + data.price;
                            document.getElementById("product-image").src = "images/" + data.image;

                            document.getElementById("cart-popup").style.display = "flex";
                        });
                }
            });
    });
});
