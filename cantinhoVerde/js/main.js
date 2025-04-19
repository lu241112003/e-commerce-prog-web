// Funcionalidades gerais do site
document.addEventListener("DOMContentLoaded", function () {
  // Menu mobile
  const menuToggle = document.querySelector(".menu-toggle");
  const navMenu = document.querySelector(".nav-menu");

  if (menuToggle) {
    menuToggle.addEventListener("click", function () {
      navMenu.classList.toggle("active");
      menuToggle.classList.toggle("active");
    });
  }

  // Inicializar carrossel se existir
  initializeCarousel();

  // Inicializar funcionalidades de produtos
  initializeProductFunctions();

  // Inicializar funcionalidades de carrinho
  initializeCartFunctions();

  // Inicializar validação de formulários
  initializeFormValidation();
});

// Função para inicializar carrossel
function initializeCarousel() {
  const carousel = document.querySelector(".carousel");
  if (!carousel) return;

  const slides = carousel.querySelectorAll(".carousel-item");
  const dotsContainer = carousel.querySelector(".carousel-dots");
  let currentSlide = 0;

  // Criar pontos de navegação
  slides.forEach((_, index) => {
    const dot = document.createElement("span");
    dot.classList.add("carousel-dot");
    if (index === 0) dot.classList.add("active");
    dot.addEventListener("click", () => goToSlide(index));
    dotsContainer.appendChild(dot);
  });

  // Configurar botões de navegação
  const prevBtn = carousel.querySelector(".carousel-prev");
  const nextBtn = carousel.querySelector(".carousel-next");

  if (prevBtn) prevBtn.addEventListener("click", prevSlide);
  if (nextBtn) nextBtn.addEventListener("click", nextSlide);

  // Funções de navegação
  function goToSlide(n) {
    slides[currentSlide].classList.remove("active");
    dotsContainer
      .querySelectorAll(".carousel-dot")
      [currentSlide].classList.remove("active");

    currentSlide = (n + slides.length) % slides.length;

    slides[currentSlide].classList.add("active");
    dotsContainer
      .querySelectorAll(".carousel-dot")
      [currentSlide].classList.add("active");
  }

  function nextSlide() {
    goToSlide(currentSlide + 1);
  }

  function prevSlide() {
    goToSlide(currentSlide - 1);
  }

  // Auto-play
  setInterval(nextSlide, 5000);
}

// Função para inicializar funcionalidades de produtos
function initializeProductFunctions() {
  // Adicionar ao carrinho
  const addToCartButtons = document.querySelectorAll(".add-to-cart");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      const productId = this.getAttribute("data-id");
      const productName = this.getAttribute("data-name");
      const productPrice = this.getAttribute("data-price");
      const productImage = this.getAttribute("data-image");
      const quantity = 1;

      addToCart(productId, productName, productPrice, productImage, quantity);

      // Mostrar mensagem de sucesso
      showNotification("Produto adicionado ao carrinho!");
    });
  });

  // Filtros de produtos
  const filterButtons = document.querySelectorAll(".filter-button");
  const productItems = document.querySelectorAll(".product-item");

  filterButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const filter = this.getAttribute("data-filter");

      // Remover classe ativa de todos os botões
      filterButtons.forEach((btn) => btn.classList.remove("active"));

      // Adicionar classe ativa ao botão clicado
      this.classList.add("active");

      // Filtrar produtos
      productItems.forEach((item) => {
        if (filter === "all") {
          item.style.display = "block";
        } else {
          if (item.classList.contains(filter)) {
            item.style.display = "block";
          } else {
            item.style.display = "none";
          }
        }
      });
    });
  });

  // Ordenação de produtos
  const sortSelect = document.querySelector(".sort-select");
  if (sortSelect) {
    sortSelect.addEventListener("change", function () {
      const sortValue = this.value;
      const productContainer = document.querySelector(".products-grid");
      const products = Array.from(
        productContainer.querySelectorAll(".product-item")
      );

      products.sort((a, b) => {
        const priceA = parseFloat(a.getAttribute("data-price"));
        const priceB = parseFloat(b.getAttribute("data-price"));

        if (sortValue === "price-asc") {
          return priceA - priceB;
        } else if (sortValue === "price-desc") {
          return priceB - priceA;
        } else if (sortValue === "name-asc") {
          return a
            .getAttribute("data-name")
            .localeCompare(b.getAttribute("data-name"));
        } else if (sortValue === "name-desc") {
          return b
            .getAttribute("data-name")
            .localeCompare(a.getAttribute("data-name"));
        }

        return 0;
      });

      // Remover todos os produtos
      products.forEach((product) => product.remove());

      // Adicionar produtos ordenados
      products.forEach((product) => productContainer.appendChild(product));
    });
  }
}

// Função para inicializar funcionalidades de carrinho
function initializeCartFunctions() {
  updateCartCount();

  // Atualizar quantidade no carrinho
  const quantityInputs = document.querySelectorAll(".cart-quantity");

  quantityInputs.forEach((input) => {
    input.addEventListener("change", function () {
      const productId = this.getAttribute("data-id");
      const quantity = parseInt(this.value);

      if (quantity < 1) {
        this.value = 1;
        updateCartItem(productId, 1);
      } else {
        updateCartItem(productId, quantity);
      }

      updateCartTotal();
    });
  });

  // Remover item do carrinho
  const removeButtons = document.querySelectorAll(".remove-from-cart");

  removeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.getAttribute("data-id");
      removeFromCart(productId);

      // Remover elemento do DOM
      this.closest(".cart-item").remove();

      updateCartTotal();
      updateCartCount();

      // Mostrar mensagem de sucesso
      showNotification("Produto removido do carrinho!");
    });
  });

  // Limpar carrinho
  const clearCartButton = document.querySelector(".clear-cart");

  if (clearCartButton) {
    clearCartButton.addEventListener("click", function () {
      clearCart();

      // Remover todos os itens do DOM
      document.querySelectorAll(".cart-item").forEach((item) => item.remove());

      updateCartTotal();
      updateCartCount();

      // Mostrar mensagem de sucesso
      showNotification("Carrinho esvaziado!");
    });
  }
}

// Função para inicializar validação de formulários
function initializeFormValidation() {
  const forms = document.querySelectorAll("form");

  forms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      const requiredFields = form.querySelectorAll("[required]");
      let isValid = true;

      requiredFields.forEach((field) => {
        if (!field.value.trim()) {
          isValid = false;
          field.classList.add("error");

          // Adicionar mensagem de erro
          const errorMessage = field.nextElementSibling;
          if (
            errorMessage &&
            errorMessage.classList.contains("error-message")
          ) {
            errorMessage.textContent = "Este campo é obrigatório.";
          } else {
            const message = document.createElement("span");
            message.classList.add("error-message");
            message.textContent = "Este campo é obrigatório.";
            field.parentNode.insertBefore(message, field.nextSibling);
          }
        } else {
          field.classList.remove("error");

          // Remover mensagem de erro
          const errorMessage = field.nextElementSibling;
          if (
            errorMessage &&
            errorMessage.classList.contains("error-message")
          ) {
            errorMessage.textContent = "";
          }
        }
      });

      // Validar email
      const emailField = form.querySelector('input[type="email"]');
      if (emailField && emailField.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value.trim())) {
          isValid = false;
          emailField.classList.add("error");

          // Adicionar mensagem de erro
          const errorMessage = emailField.nextElementSibling;
          if (
            errorMessage &&
            errorMessage.classList.contains("error-message")
          ) {
            errorMessage.textContent = "Por favor, insira um email válido.";
          } else {
            const message = document.createElement("span");
            message.classList.add("error-message");
            message.textContent = "Por favor, insira um email válido.";
            emailField.parentNode.insertBefore(message, emailField.nextSibling);
          }
        }
      }

      if (!isValid) {
        e.preventDefault();
      }
    });
  });
}

// Funções de manipulação do carrinho
function getCart() {
  const cart = localStorage.getItem("cart");
  return cart ? JSON.parse(cart) : [];
}

function saveCart(cart) {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function addToCart(id, name, price, image, quantity) {
  const cart = getCart();
  const existingItem = cart.find((item) => item.id === id);

  if (existingItem) {
    existingItem.quantity += quantity;
  } else {
    cart.push({ id, name, price, image, quantity });
  }

  saveCart(cart);
  updateCartCount();
}

function updateCartItem(id, quantity) {
  const cart = getCart();
  const item = cart.find((item) => item.id === id);

  if (item) {
    item.quantity = quantity;
    saveCart(cart);
  }
}

function removeFromCart(id) {
  const cart = getCart();
  const updatedCart = cart.filter((item) => item.id !== id);
  saveCart(updatedCart);
}

function clearCart() {
  localStorage.removeItem("cart");
}

function updateCartCount() {
  const cart = getCart();
  const count = cart.reduce((total, item) => total + item.quantity, 0);

  const cartCountElements = document.querySelectorAll(".cart-count");
  cartCountElements.forEach((element) => {
    element.textContent = count;

    if (count > 0) {
      element.classList.add("active");
    } else {
      element.classList.remove("active");
    }
  });
}

function updateCartTotal() {
  const totalElement = document.querySelector(".cart-total");
  if (!totalElement) return;

  const cart = getCart();
  const total = cart.reduce(
    (sum, item) => sum + parseFloat(item.price) * item.quantity,
    0
  );

  totalElement.textContent = `R$ ${total.toFixed(2)}`;
}

// Função para mostrar notificações
function showNotification(message) {
  const notification = document.createElement("div");
  notification.classList.add("notification");
  notification.textContent = message;

  document.body.appendChild(notification);

  // Mostrar notificação
  setTimeout(() => {
    notification.classList.add("show");
  }, 10);

  // Esconder e remover notificação
  setTimeout(() => {
    notification.classList.remove("show");

    setTimeout(() => {
      notification.remove();
    }, 300);
  }, 3000);
}
