// src/pages/Vendendo.jsx
import React, { useState } from 'react';
import { Link } from 'react-router-dom'; // Para navegação entre páginas
import '../styles/vendendo.css'; // Estilo correspondente à página
//import { readLugares } from '../services/api-lugares';
//import { postVenda } from '../services/api-vendas';
//import { postItensVenda } from '../services/api-itensVenda'
//import { readProdutos } from '../services/api-produtos';

function Vendendo() {
  // Estado para armazenar os itens no carrinho
  const [carrinho, setCarrinho] = useState([]);

  // Produtos disponíveis
  const produtos = [
    { id: 1, nome: 'Produto A', preco: 50.00 },
    { id: 2, nome: 'Produto B', preco: 30.00 },
    { id: 3, nome: 'Produto C', preco: 20.00 }
  ];

  // Função para adicionar produtos ao carrinho
  const adicionarAoCarrinho = (produto) => {
    setCarrinho([...carrinho, produto]);
  };

  return (
    <div className="container">
      <header>
        <h1>Vendendo</h1>
      </header>

      <div className="sales-list">
        <h2>Produtos Disponíveis</h2>

        <ul>
          {produtos.map((produto) => (
            <li key={produto.id}>
              {produto.nome} - R$ {produto.preco.toFixed(2)} 
              <button 
                className="btn-add-to-cart"
                onClick={() => adicionarAoCarrinho(produto)}
              >
                Adicionar ao Carrinho
              </button>
            </li>
          ))}
        </ul>

        {/* Exibindo o link para finalizar a venda */}
        <Link to="/finalizar-venda" className="btn-finalize-sale">
          Finalizar Venda
        </Link>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default Vendendo;
