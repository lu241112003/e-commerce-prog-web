document.addEventListener('DOMContentLoaded', function () {
  // Elementos da página
  const emptyWishlist = document.getElementById('emptyWishlist');
  const wishlistProducts = document.getElementById('wishlistProducts');
  const wishlistCount = document.getElementById('wishlistCount');

  // Carregar lista de desejos do localStorage
  function loadWishlist() {
    const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Atualizar contador
    wishlistCount.textContent = wishlist.length;

    // Mostrar mensagem de lista vazia ou produtos
    if (wishlist.length === 0) {
      emptyWishlist.style.display = 'block';
      wishlistProducts.style.display = 'none';
    } else {
      emptyWishlist.style.display = 'none';
      wishlistProducts.style.display = 'grid';
      renderWishlistItems(wishlist);
    }
  }

  // Renderizar itens da lista de desejos
  function renderWishlistItems(wishlist) {
    wishlistProducts.innerHTML = '';

    wishlist.forEach((product) => {
      const productElement = document.createElement('div');
      productElement.className = 'wishlist-item';
      productElement.dataset.id = product.id;

      productElement.innerHTML = `
              <div class="wishlist-item-image">
                  <img src="${product.image}" alt="${product.name}">
              </div>
              <div class="wishlist-item-content">
                  <h3 class="wishlist-item-title">${product.name}</h3>
                  <div class="wishlist-item-category">${product.category}</div>
                  <div class="wishlist-item-price">R$ ${product.price.toFixed(
                    2
                  )}</div>
                  <div class="wishlist-item-actions">
                      <button class="btn btn-primary add-to-cart" data-id="${
                        product.id
                      }">
                          <i class="fas fa-shopping-cart"></i> Adicionar
                      </button>
                      <button class="remove-from-wishlist" data-id="${
                        product.id
                      }">
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </div>
              </div>
          `;

      wishlistProducts.appendChild(productElement);
    });

    // Adicionar event listeners para os botões
    addEventListeners();
  }

  // Adicionar event listeners para os botões de ação
  function addEventListeners() {
    // Botões de remover da lista de desejos
    const removeButtons = document.querySelectorAll('.remove-from-wishlist');
    removeButtons.forEach((button) => {
      button.addEventListener('click', function () {
        const productId = this.dataset.id;
        removeFromWishlist(productId);
      });
    });

    // Botões de adicionar ao carrinho
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach((button) => {
      button.addEventListener('click', function () {
        const productId = this.dataset.id;
        addToCart(productId);
      });
    });
  }

  // Remover produto da lista de desejos
  function removeFromWishlist(productId) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Filtrar o produto a ser removido
    wishlist = wishlist.filter((product) => product.id !== productId);

    // Atualizar localStorage
    localStorage.setItem('wishlist', JSON.stringify(wishlist));

    // Recarregar a lista
    loadWishlist();

    // Mostrar mensagem de sucesso
    showNotification('Produto removido da lista de desejos');
  }

  // Adicionar produto ao carrinho
  function addToCart(productId) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Encontrar o produto na lista de desejos
    const product = wishlist.find((product) => product.id === productId);

    if (product) {
      // Verificar se o produto já está no carrinho
      const existingProduct = cart.find((item) => item.id === productId);

      if (existingProduct) {
        // Incrementar quantidade
        existingProduct.quantity += 1;
      } else {
        // Adicionar novo produto ao carrinho
        product.quantity = 1;
        cart.push(product);
      }

      // Atualizar localStorage
      localStorage.setItem('cart', JSON.stringify(cart));

      // Atualizar contador do carrinho
      updateCartCount();

      // Mostrar mensagem de sucesso
      showNotification('Produto adicionado ao carrinho');
    }
  }

  // Atualizar contador do carrinho
  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartCount = document.getElementById('cartCount');

    // Calcular total de itens
    const totalItems = cart.reduce(
      (total, product) => total + product.quantity,
      0
    );

    cartCount.textContent = totalItems;
  }

  // Mostrar notificação
  function showNotification(message) {
    // Verificar se já existe uma notificação
    let notification = document.querySelector('.notification');

    if (!notification) {
      notification = document.createElement('div');
      notification.className = 'notification';
      document.body.appendChild(notification);
    }

    notification.textContent = message;
    notification.classList.add('show');

    // Remover notificação após 3 segundos
    setTimeout(() => {
      notification.classList.remove('show');
    }, 3000);
  }

  // Inicializar a página
  loadWishlist();
  updateCartCount();
});
