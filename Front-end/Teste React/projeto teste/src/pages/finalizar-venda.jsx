import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import '../styles/finalizar-venda.css';
import { putVenda } from '../services/api-vendas';
import { readItensVendaByIdVenda } from '../services/api-itensVendas';

function FinalizarVenda() {
  const [itensVenda, setItensVenda] = useState([]);
  const [totalAmount, setTotalAmount] = useState(0);
  const [paymentMethod, setPaymentMethod] = useState('dinheiro');

  useEffect(() => {
    const idVenda = localStorage.getItem('idVenda'); // Supondo que o id da venda esteja armazenado
    async function fetchItensVenda() {
      const response = await readItensVendaByIdVenda(idVenda);
      setItensVenda(response);

      // Calcula o total somando os subtotais de cada item
      const total = response.reduce((acc, item) => acc + item.subtotal, 0);
      setTotalAmount(total);
    }
    fetchItensVenda();
  }, []);

  const handlePaymentMethodChange = (e) => {
    setPaymentMethod(e.target.value);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const idVenda = localStorage.getItem('idVenda'); // Supondo que o id da venda esteja armazenado
    const totalAmount = 100; // Exemplo de novo total da venda
    const paymentMethod = 'cartão'; // Exemplo de forma de pagamento
    const statusVenda = 'Concluída'; // Exemplo de novo status

    try {
        // Chama a função de atualização
        const response = await putVenda(idVenda, totalAmount, paymentMethod, statusVenda);
        
        Swal.fire({
            title: 'Venda Concluída!',
            text: 'A venda foi concluída com sucesso.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            navigate('/visualizar-vendas-concluidas');
        });
    } catch (error) {
        console.error("Erro ao atualizar a venda:", error);
        Swal.fire({
            title: 'Erro!',
            text: 'Não foi possível concluir a venda.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Finalizar Venda</h1>
      </header>

      <div className="sales-summary">
        <h2>Resumo da Venda</h2>
        <ul>
          {itensVenda.map((item) => (
            <li key={item.id_produto}>
              {item.nome} - Quantidade: {item.quantidade} - Subtotal: R$ {item.subtotal.toFixed(2)}
            </li>
          ))}
        </ul>
        <h3>Total: R$ {totalAmount.toFixed(2)}</h3>
      </div>

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
            value={`R$ ${totalAmount.toFixed(2)}`}
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