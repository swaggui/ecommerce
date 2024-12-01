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
    </div>
</div>

<script>
    const precoRange = document.getElementById('preco');
    const valorPreco = document.getElementById('valorPreco');
    precoRange.addEventListener('input', () => {
        valorPreco.textContent = precoRange.value;
    });
</script>

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
    <div class="cart-footer">
        <p id="cartTotal">Total: R$ 0,00</p>
        <button class="btn w-100" style="background-color: rgb(198, 159, 104); color: white;">Finalizar Compra</button>
    </div>
</div>
<script>
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Adicionar produto ao carrinho
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const nome = button.dataset.nome;
            const preco = parseFloat(button.dataset.preco);

            // Verificar se o produto já está no carrinho
            const existingProduct = cart.find(item => item.id === id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ id, nome, preco, quantity: 1 });
            }

            // Atualizar o LocalStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart(); // Atualizar a sidebar
            alert(`Produto "${nome}" adicionado ao carrinho!`);
        });
    });

    // Renderizar o carrinho na sidebar
    function renderCart() {
        const cartContent = document.getElementById('cartItems');
        const emptyMessage = document.getElementById('emptyCartMessage');
        const cartTotal = document.getElementById('cartTotal');

        // Limpar a lista atual
        cartContent.innerHTML = '';

        if (cart.length === 0) {
            emptyMessage.style.display = 'block';
            cartTotal.textContent = 'Total: R$ 0,00';
            return;
        }

        emptyMessage.style.display = 'none';

        // Adicionar itens à lista
        let total = 0;
        cart.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                <span>
                    ${item.nome} (x${item.quantity})
                </span>
                <span>R$ ${(item.preco * item.quantity).toFixed(2).replace('.', ',')}</span>
            `;
            cartContent.appendChild(li);
            total += item.preco * item.quantity;
        });

        cartTotal.textContent = `Total: R$ ${total.toFixed(2).replace('.', ',')}`;
    }

    // Atualizar o carrinho ao carregar a página
    document.addEventListener('DOMContentLoaded', renderCart);
</script>

<script>
    document.getElementById("calcFreteBtn").addEventListener("click", function() {
        const cep = document.getElementById("cep").value;
        if (!cep) {
            alert("Por favor, insira um CEP válido.");
            return;
        }

        fetch(`calcular_frete.php?cep=${cep}`)
            .then(response => response.json())
            .then(data => {
                const freteList = document.getElementById("freteList");
                freteList.innerHTML = "";
                data.sugestoes.forEach(sugestao => {
                    const li = document.createElement("li");
                    li.textContent = `${sugestao.tipo}: R$ ${sugestao.preco}`;
                    freteList.appendChild(li);
                });
                document.getElementById("freteSugestoes").style.display = "block";
            })
            .catch(error => {
                console.error("Erro ao calcular o frete:", error);
                alert("Erro ao calcular o frete. Tente novamente mais tarde.");
            });
    });
</script>
<div class="container mt-5">
    <div class="row mt-4">
        <?php foreach ($produtos as $produto): ?>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm" style="border: none;">
                    <!-- Imagem do Produto -->
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
                        <!-- Nome do Produto -->
                        <h5 class="card-title"><?= h($produto->nome) ?></h5>
                        <!-- Preço do Produto -->
                        <p class="card-text">R$ <?= number_format($produto->preco, 2, ',', '.') ?></p>
                        <!-- Botão de Adicionar ao Carrinho -->
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
<script>
    const cart = [];

    // Adicionar produto ao carrinho
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const nome = button.dataset.nome;
            const preco = parseFloat(button.dataset.preco);

            // Verificar se o produto já está no carrinho
            const existingProduct = cart.find(item => item.id === id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ id, nome, preco, quantity: 1 });
            }

            // Atualizar o LocalStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`Produto "${nome}" adicionado ao carrinho!`);
        });
    });

    // Exibir carrinho no console (para testes)
    document.getElementById('cartButton').addEventListener('click', () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        console.log(cart);
    });
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
</style>

<script>
    function toggleCart() {
        const cartSidebar = document.getElementById("cartSidebar");
        const produtosCarousel = document.getElementById("produtosCarousel");
        cartSidebar.classList.toggle("open");
        produtosCarousel.classList.toggle("carousel-narrow");
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
