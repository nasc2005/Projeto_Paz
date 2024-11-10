// src/pages/FinalizarVenda.jsx
import React, { useState } from 'react';
import '../styles/finalizar-venda.css';

function FinalizarVenda() {
  // Estado para armazenar o método de pagamento e valor total
  const [paymentMethod, setPaymentMethod] = useState('dinheiro');
  const [totalAmount] = useState('R$ 100,00'); // O valor pode vir de um cálculo ou API

  // Função para lidar com a mudança do método de pagamento
  const handlePaymentMethodChange = (e) => {
    setPaymentMethod(e.target.value);
  };

  // Função para lidar com a submissão do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    // Aqui você pode adicionar a lógica para concluir a venda
    console.log('Venda concluída com pagamento via:', paymentMethod);
  };

  return (
    <div className="container">
      <header>
        <h1>Finalizar Venda</h1>
      </header>

      <form onSubmit={handleSubmit} className="finalize-form">
        <div className="form-group">
          <label htmlFor="payment-method">Forma de Pagamento:</label>
          <select
            id="payment-method"
            name="payment-method"
            value={paymentMethod}
            onChange={handlePaymentMethodChange}
            required
          >
            <option value="dinheiro">Dinheiro</option>
            <option value="cartao">Cartão</option>
            <option value="pix">PIX</option>
          </select>
        </div>

        <div className="form-group">
          <label htmlFor="total-amount">Valor Total:</label>
          <input
            type="text"
            id="total-amount"
            name="total-amount"
            value={totalAmount}
            readOnly
          />
        </div>

        <button type="submit" className="btn-finalize">Concluir Venda</button>
      </form>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default FinalizarVenda;
