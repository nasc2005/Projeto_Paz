// src/pages/VendaConcluida.jsx
import React from 'react';
import { useParams } from 'react-router-dom'; // Para pegar parâmetros da URL se necessário
import '../styles/venda-concluida.css'; // Certifique-se de ter o arquivo CSS correspondente

function VendaConcluida() {
  // Dados fictícios da venda, idealmente isso viria de um backend ou estado global
  const venda = {
    id: '001',
    data: '15/09/2024',
    total: 'R$ 200,00',
    pagamento: 'Cartão',
    produtos: [
      { nome: 'Produto A', preco: 'R$ 50,00' },
      { nome: 'Produto B', preco: 'R$ 100,00' },
      { nome: 'Produto C', preco: 'R$ 50,00' }
    ]
  };

  return (
    <div className="container">
      <header>
        <h1>Venda #{venda.id}</h1>
      </header>

      <div className="sale-details">
        <h2>Detalhes da Venda</h2>
        <ul>
          <li><strong>Data:</strong> {venda.data}</li>
          <li><strong>Total:</strong> {venda.total}</li>
          <li><strong>Pagamento:</strong> {venda.pagamento}</li>
        </ul>
      </div>

      <div className="product-list">
        <h2>Produtos Vendidos</h2>
        <ul>
          {venda.produtos.map((produto, index) => (
            <li key={index}>{produto.nome} - {produto.preco}</li>
          ))}
        </ul>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default VendaConcluida;
