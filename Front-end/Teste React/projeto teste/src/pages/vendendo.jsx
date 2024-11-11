// src/pages/Vendendo.jsx
import { React, useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import '../styles/vendendo.css'; // Estilo correspondente à página
import { readProdutos } from '../services/api-produtos';

//import { readLugares } from '../services/api-lugares';
//import { postVenda } from '../services/api-vendas';
//import { postItensVenda } from '../services/api-itensVenda'

function Vendendo() {
  // Estado para armazenar os itens no carrinho
  const [carrinho, setCarrinho] = useState([]);
  const [produtos, setProdutos] = useState([]);

  async function getProdutos() {
    const response = await readProdutos();
    setProdutos(response);
  }

  useEffect(() => {
    getProdutos();
  }, []);

  const navigate = useNavigate();

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
            <li key={produto.id_produto}>
              {produto.nome} - R$ {produto.valor_venda.toFixed(2)} 
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