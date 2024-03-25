// Função para adicionar item ao carrinho
function addToCart(id, nome, preco) {
  var item = { id, nome, preco };
  var cart = JSON.parse(localStorage.getItem("cart")) || []; // Recupera o carrinho do localStorage ou cria um novo se não existir
  cart.push(item); // Adiciona o item ao carrinho
  localStorage.setItem("cart", JSON.stringify(cart)); // Atualiza o carrinho no localStorage
}

function deleteItem(id) {
  removeToCart(id);
  location.href = "../controller/produto.controller.php?op=deletar&id=" + id;
  alert("Item removido do cardápio!");
  location.reload();
}

function putValueItem(id) {
  let preco = Number(window.prompt("Digite o novo preco do item: ", ""));

  if (preco == null || preco == "" || isNaN(preco) || preco < 0) {
    alert("Valor inválido!");
    return;
  }

  updateItemCart(id, preco);
  location.href =
    "../controller/produto.controller.php?op=atualizar&id=" +
    id +
    "&preco=" +
    preco;
  alert("Item alterado do cardápio!");
  location.reload();
}

function updateItemCart(id, preco) {
  var cart = JSON.parse(localStorage.getItem("cart")) || [];
  //pegue o item do carrinho e altere o valor
  cart.forEach(function (item) {
    if (item.id == id) {
      item.preco = preco;
    }
  });
  localStorage.setItem("cart", JSON.stringify(cart));
}

function removeToCart(id) {
  var cart = JSON.parse(localStorage.getItem("cart")) || [];
  var newCart = cart.filter(function (item) {
    return item.id != id;
  });
  localStorage.setItem("cart", JSON.stringify(newCart));
}

// Adiciona evento de clique aos botões de adicionar item do cardápio
document.querySelectorAll(".botao-img").forEach(function (button) {
  button.addEventListener("click", function () {
    // recuperar o id no atributo data-id do .botao-img
    var itemId = this.getAttribute("data-id");
    var itemName = this.parentElement.querySelector("h3").innerText;
    var itemPrice = parseFloat(
      this.parentElement
        .querySelector("h4 span")
        .innerText.replace("R$", "")
        .replace(",", ".")
    );
    addToCart(itemId, itemName, itemPrice);
    alert(itemName + " adicionado ao carrinho!");
  });
});
