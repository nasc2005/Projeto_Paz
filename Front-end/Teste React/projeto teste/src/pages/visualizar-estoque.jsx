// src/pages/EstoqueProdutos.jsx
import { React, useEffect, useState } from 'react';
import { Link } from 'react-router-dom'; // Para navegação entre páginas
import '../styles/visualizar-estoque.css'; // Arquivo CSS da página
import { readProdutos } from '../services/api-produtos'; 

function EstoqueProdutos() {
  const [produtos, setProdutos] = useState([]);

  // Função para buscar produtos
  async function getProdutos() {
    const response = await readProdutos();
    setProdutos(response);
  
  }

  useEffect(() => {
    getProdutos();
  }, []);

  return (
    <div className="container">
      <header>
        <h1>Estoque de Produtos</h1>
      </header>

      <div className="product-list">
        <ul>
          {produtos.map((produto) => (
            <li key={produto.id_produto}>
              {produto.nome} - 
              Venda: R$ {produto.valor_venda.toFixed(2)} - 
              Custo: R$ {produto.valor_custo} - 
              Quantidade: {produto.estoque} - 
              Descrição: {produto.descricao}
              <Link to={`/editar-produto/${produto.id_produto}`} className="btn-edit">Editar</Link>
            </li>
          ))}
        </ul>
      </div>

      <Link to="/adicionar-produto" className="btn-add-product">Adicionar Produto</Link>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EstoqueProdutos;