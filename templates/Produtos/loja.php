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
        <?php foreach ($produtos as $index => $produto): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm" style="border: none;">
                            <div class="card-img-top text-center">
                                <!-- Use o nome da imagem diretamente, assim como testou -->
                                <?= $this->Html->image('/img/produto1.jpg' . h($produto->imagem), ['alt' => h($produto->nome), 'class' => 'img-fluid', 'style' => 'max-height: 200px;']) ?>
                            </div>
                            <div class="card-body text-center" style="background-color: rgb(47, 80, 61); color: white;">
                                <h5><?= h($produto->nome) ?></h5>
                                <p class="card-text"><?= h($produto->descricao) ?></p>
                                <p class="card-text" style="color: rgb(198, 159, 104); font-weight: bold;">R$ <?= $this->Number->format($produto->preco) ?></p>
                                <?= $this->Html->link('Ver detalhes', ['action' => 'view', $produto->id], ['class' => 'btn btn-light']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#produtosCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#produtosCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<img src="/img/produto1.jpg" alt="Teste Produto 1">
<img src="/img/produto2.jpg" alt="Teste Produto 2">
<img src="/img/produto3.jpg" alt="Teste Produto 3">

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

        <div class="frete-calc">
            <h5>Calcular Frete</h5>
            <input type="text" id="cep" placeholder="Digite seu CEP" class="form-control" />
            <button id="calcFreteBtn" class="btn btn-light mt-2">Calcular Frete</button>
        </div>

        <div id="freteSugestoes" style="display:none;">
            <h6>Sugestões de Frete:</h6>
            <ul id="freteList"></ul>
        </div>
    </div>
    <div class="cart-footer">
        <button class="btn w-100" style="background-color: rgb(198, 159, 104); color: white;">Finalizar Compra</button>
    </div>
</div>

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
