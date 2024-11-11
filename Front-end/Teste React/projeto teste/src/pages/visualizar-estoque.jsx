// src/pages/EstoqueProdutos.jsx
import { React, useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import '../styles/visualizar-estoque.css';
import { readProdutos } from '../services/api-produtos';

function EstoqueProdutos() {
  const [produtos, setProdutos] = useState([]);

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

      <div className="product-table">
        <table>
          <thead>
            <tr>
              <th>Nome</th>
              <th>Valor de Venda</th>
              <th>Valor de Custo</th>
              <th>Quantidade</th>
              <th>Descrição</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            {produtos.map((produto) => (
              <tr key={produto.id_produto}>
                <td>{produto.nome}</td>
                <td>R$ {produto.valor_venda.toFixed(2)}</td>
                <td>R$ {produto.valor_custo.toFixed(2)}</td>
                <td>{produto.estoque}</td>
                <td>{produto.descricao}</td>
                <td>
                  <Link to={`/editar-produto/${produto.id_produto}`} className="btn-edit">Editar</Link>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <Link to="/adicionar-produto" className="btn-add-product">Adicionar Produto</Link>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EstoqueProdutos;