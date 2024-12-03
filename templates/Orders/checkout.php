<div class="container mt-5">
    <h2 class="text-center">Finalização da Compra</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow-sm" style="border: none; background-color: rgb(198, 159, 104); color: #fff;">
                <h4>Resumo do Pedido</h4>
                <div id="orderSummary" class="mb-4">
                </div>
                <h4>Dados do Cliente</h4>
                <form id="checkoutForm">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <textarea class="form-control" id="endereco" name="endereco" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" maxlength="8" required>
                    </div>
                    <h4>Pagamento</h4>
                    <div class="mb-3">
                        <label for="metodoPagamento" class="form-label">Método de Pagamento</label>
                        <select class="form-select" id="metodoPagamento" name="metodoPagamento" required>
                            <option value="boleto">Boleto Bancário</option>
                            <option value="cartao">Cartão de Crédito</option>
                            <option value="pix">Pix</option>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Finalizar Compra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const orderSummary = document.getElementById('orderSummary');

        if (cart.length === 0) {
            orderSummary.innerHTML = '<p>O carrinho está vazio!</p>';
            return;
        }

        let total = 0;
        const summaryList = document.createElement('ul');
        summaryList.className = 'list-group';

        cart.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.textContent = `${item.nome} (x${item.quantity}) - R$ ${(item.preco * item.quantity).toFixed(2).replace('.', ',')}`;
            summaryList.appendChild(li);
            total += item.preco * item.quantity;
        });

        const totalLi = document.createElement('li');
        totalLi.className = 'list-group-item d-flex justify-content-between align-items-center fw-bold';
        totalLi.textContent = `Total: R$ ${total.toFixed(2).replace('.', ',')}`;
        summaryList.appendChild(totalLi);

        orderSummary.appendChild(summaryList);
    });

    document.getElementById('checkoutForm').addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        alert('Compra finalizada com sucesso!');
        localStorage.removeItem('cart');
        window.location.href = '/';
    });
</script>
