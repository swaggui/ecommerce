<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Produto> $produtos
 */
?>
<div class="container mt-5">
    <h2 class="text-center">Nossos Produtos</h2>
</div>

<?php
$imagens = ['produto1.jpg', 'produto2.jpg', 'produto3.jpg'];
?>
<div id="produtosCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($imagens as $index => $imagem): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <?= $this->Html->image($imagem, [
                            'alt' => "Imagem {$index}",
                            'class' => 'img-fluid',
                            'style' => 'max-height: 400px;',
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#produtosCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#produtosCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-3 mb-4 shadow-sm" style="border: none; background-color: rgb(198, 159, 104);">
                <h4>Filtros</h4>
                <div class="mb-3">
                    <h5>Categoria</h5>
                    <div>
                        <input type="checkbox" id="categoria1" name="categoria[]" value="categoria1">
                        <label for="categoria1">Blusas</label>
                    </div>
                    <div>
                        <input type="checkbox" id="categoria2" name="categoria[]" value="categoria2">
                        <label for="categoria2">Moletons</label>
                    </div>
                </div>
                <div class="mb-3">
                    <h5>Cor</h5>
                    <select name="cor" class="form-select">
                        <option value="">Selecione uma cor</option>
                        <option value="vermelho">Vermelho</option>
                        <option value="azul">Azul</option>
                        <option value="verde">Verde</option>
                    </select>
                </div>
                <div class="mb-3">
                    <h5>Faixa de Preço</h5>
                    <input type="range" class="form-range" min="0" max="1000" id="preco" name="preco">
                    <p>Até R$ <span id="valorPreco">500</span></p>
                </div>
                <button class="btn w-100" type="submit" style="background-color: rgb(47, 80, 61); color: white;">Aplicar Filtros</button>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php foreach ($produtos as $produto): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card shadow-sm" style="border: none;">
                            <div class="card-img-top">
                                <?= $this->Html->image(
                                    'produtos/' . $produto->imagem,
                                    [
                                        'alt' => $produto->nome,
                                        'class' => 'img-fluid',
                                        'style' => 'max-height: 200px; object-fit: cover;'
                                    ]
                                ) ?>
                            </div>
                            <div class="card-body text-center" style="background-color: rgb(198, 159, 104); color: white;">
                                <h5 class="card-title"><?= h($produto->nome) ?></h5>
                                <p class="card-text">R$ <?= number_format($produto->preco, 2, ',', '.') ?></p>
                                <button class="btn btn-dark add-to-cart"
                                        data-id="<?= $produto->id ?>"
                                        data-nome="<?= h($produto->nome) ?>"
                                        data-preco="<?= $produto->preco ?>">
                                    Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <button id="cartButton" class="btn btn-dark" onclick="toggleCart()">🛒 Carrinho</button>

        <div id="cartSidebar" class="cart-sidebar">
            <div class="cart-header">
                <h5>Carrinho de Compras</h5>
                <button class="close-btn" onclick="toggleCart()">×</button>
            </div>
            <div id="cartContent" class="cart-content">
                <p id="emptyCartMessage">Seu carrinho está vazio. Adicione produtos para começar!</p>
                <ul id="cartItems" class="list-group"></ul>
            </div>

            <div class="frete-calculator mt-4">
                <h6>Calcular Frete</h6>
                <div class="mb-3">
                    <input type="text" id="cep" class="form-control" placeholder="Digite seu CEP" maxlength="8">
                </div>
                <button id="calcFreteBtn" class="btn btn-sm btn-light">Calcular</button>
                <div id="freteSugestoes" style="display: none;" class="mt-3">
                    <h6>Opções de Frete</h6>
                    <ul id="freteList" class="list-group"></ul>
                </div>
            </div>

            <div class="cart-footer">
                <p id="cartTotal">Total: R$ 0,00</p>
                <button class="btn w-100" style="background-color: rgb(198, 159, 104); color: white;" onclick="window.location.href='/checkout'">Finalizar Compra</button>
            </div>
        </div>

<script>
    const precoRange = document.getElementById('preco');
    const valorPreco = document.getElementById('valorPreco');
    precoRange.addEventListener('input', () => {
        valorPreco.textContent = precoRange.value;
    });
            function toggleCart() {
                const cartSidebar = document.getElementById("cartSidebar");
                const produtosCarousel = document.getElementById("produtosCarousel");
                cartSidebar.classList.toggle("open");
                produtosCarousel.classList.toggle("carousel-narrow");
            }

            document.getElementById("calcFreteBtn").addEventListener("click", function () {
                const cep = document.getElementById("cep").value;

                if (!cep || cep.length !== 8) {
                    alert("Por favor, insira um CEP válido (8 dígitos).");
                    return;
                }

                const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
                if (cartItems.length === 0) {
                    alert("Seu carrinho está vazio. Adicione produtos antes de calcular o frete.");
                    return;
                }

                const totalWeight = cartItems.reduce((sum, item) => sum + (item.quantity * 0.5), 0);

                // Simulação do cálculo de frete
                const freteOptions = [
                    { id: "economico", name: "Econômico", price: (totalWeight * 5 + 10).toFixed(2) },
                    { id: "expresso", name: "Expresso", price: (totalWeight * 10 + 20).toFixed(2) },
                ];

                const freteList = document.getElementById("freteList");
                freteList.innerHTML = "";

                freteOptions.forEach(option => {
                    const li = document.createElement("li");
                    li.classList.add("list-group-item");

                    li.innerHTML = `
            <input type="radio" name="freteOption" id="${option.id}" value="${option.price}" class="me-2">
            <label for="${option.id}">${option.name}: R$ ${option.price.replace('.', ',')}</label>
        `;
                    freteList.appendChild(li);
                });

                document.getElementById("freteSugestoes").style.display = "block";

                const radios = document.querySelectorAll('input[name="freteOption"]');
                radios.forEach(radio => {
                    radio.addEventListener("change", updateTotalWithFrete);
                });
            });

            function updateTotalWithFrete() {
                const selectedFrete = document.querySelector('input[name="freteOption"]:checked');
                const fretePrice = selectedFrete ? parseFloat(selectedFrete.value) : 0;

                const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
                const cartTotal = cartItems.reduce((total, item) => total + (item.preco * item.quantity), 0);

                const total = cartTotal + fretePrice;
                document.getElementById("cartTotal").textContent = `Total: R$ ${total.toFixed(2).replace('.', ',')}`;
            }

    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('add-to-cart')) {
            const button = event.target;
            const id = button.dataset.id;
            const nome = button.dataset.nome;
            const preco = parseFloat(button.dataset.preco);

            const existingProduct = cart.find(item => item.id === id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ id, nome, preco, quantity: 1 });
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            renderCart();

            const cartSidebar = document.getElementById("cartSidebar");
            cartSidebar.classList.add("open");

            alert(`Produto "${nome}" adicionado ao carrinho!`);
        }
    });

    function renderCart() {
        const cartContent = document.getElementById('cartItems');
        const emptyMessage = document.getElementById('emptyCartMessage');
        const cartTotal = document.getElementById('cartTotal');

        cartContent.innerHTML = '';

        if (cart.length === 0) {
            emptyMessage.style.display = 'block';
            cartTotal.textContent = 'Total: R$ 0,00';
            return;
        }

        emptyMessage.style.display = 'none';

        let total = 0;
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
            <span>
                ${item.nome} (x${item.quantity})
            </span>
            <span>
                R$ ${(item.preco * item.quantity).toFixed(2).replace('.', ',')}
                <button class="btn btn-danger btn-sm remove-from-cart" data-index="${index}">Remover</button>
            </span>
        `;
            cartContent.appendChild(li);
            total += item.preco * item.quantity;
        });

        cartTotal.textContent = `Total: R$ ${total.toFixed(2).replace('.', ',')}`;

        const removeButtons = document.querySelectorAll('.remove-from-cart');
        removeButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const index = event.target.dataset.index;
                removeFromCart(index);
            });
        });
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }



    function toggleCart() {
        const cartSidebar = document.getElementById("cartSidebar");
        const produtosCarousel = document.getElementById("produtosCarousel");
        cartSidebar.classList.toggle("open");
        produtosCarousel.classList.toggle("carousel-narrow");
    }
</script>


<style>
    .carousel-fullwidth {
        transition: margin-right 0.3s ease;
    }

    .carousel-narrow {
        margin-right: 350px;
    }

    .cart-sidebar {
        position: fixed;
        right: -300px;
        top: 0;
        width: 300px;
        height: 100%;
        background-color: rgb(47, 80, 61);
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        padding: 20px;
        transition: right 0.3s ease;
        overflow-y: auto;
    }
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .close-btn {
        font-size: 1.5rem;
        border: none;
        background: none;
        cursor: pointer;
    }
    .cart-footer {
        border-top: 1px solid #ddd;
        padding-top: 10px;
        margin-top: 20px;
    }
    #cartButton {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 1000;
        font-size: 1.2rem;
    }
    .cart-sidebar.open {
        right: 0;
    }
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-body {
        padding: 15px;
    }
    #cartButton {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 1000;
        font-size: 1.2rem;
        padding: 10px 20px;
        width: auto;
        height: auto;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
