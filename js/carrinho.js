// Recupera os itens do carrinho do localStorage e exibe-os na página
function displayCartItems() {
  var cartItems = JSON.parse(localStorage.getItem("cart")) || []; // Recupera os itens do carrinho do localStorage
  var cartList = document.getElementById("cart-items");
  var totalPrice = 0;

  cartList.innerHTML = ""; // Limpa a lista antes de adicionar os itens

  cartItems.forEach(function (item) {
    var listItem = document.createElement("li");
    var checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.checked = true; // Marcado por padrão
    checkbox.addEventListener("change", function () {
      if (checkbox.checked) {
        totalPrice += item.preco;
      } else {
        totalPrice -= item.preco;
      }
      document.getElementById("total-price").textContent =
        totalPrice.toFixed(2);
    });

    listItem.appendChild(checkbox);
    listItem.appendChild(
      document.createTextNode(item.nome + " - R$" + item.preco.toFixed(2))
    );
    cartList.appendChild(listItem);
    totalPrice += item.preco;
  });

  // Atualiza o total
  document.getElementById("total-price").textContent = totalPrice.toFixed(2);
}

function cleanAll() {
  localStorage.removeItem("cart"); // Limpa o carrinho no localStorage
  localStorage.removeItem("usuario"); // Limpa o usuário no localStorage
  displayCartItems(); // Atualiza a exibição dos itens
}

// Chama a função para exibir os itens do carrinho quando a página é carregada
window.onload = function () {
  displayCartItems();
};

function finalizarPedido() {
  let getCart = localStorage.getItem("cart");
  let getUsuario = localStorage.getItem("usuario");

  if (!getCart) {
    alert("Carrinho vazio!");
    return;
  }

  fetch(
    "../controller/pedido.controller.php?op=cadastrar&pedido=" +
      getCart +
      "&usuario=" +
      getUsuario
  )
    .then((response) => response)
    .then((data) => {
      console.log(data);
      alert("Pedido finalizado!");
      cleanAll(); // Limpa o carrinho e o usuário
      location.href = "../index.html";
    });
}
