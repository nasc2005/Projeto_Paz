// src/pages/VendasConcluidas.jsx
import { React, useEffect, useState } from 'react';
import { Link } from 'react-router-dom'; // Para navegação entre páginas
import '../styles/visualizar-vendas-concluidas.css'; // Arquivo CSS da página
import { readVendas } from '../services/api-vendas';

function VendasConcluidas() {
  const [vendas, setVendas] = useState([]);

  // Função para buscar vendas
  async function getVendas() {
    const response = await readVendas();
    setVendas(response);
  }

  useEffect(() => {
    getVendas();
  }, []);

  return (
    <div className="container">
      <header>
        <h1>Vendas Concluídas</h1>
      </header>

      <div className="sales-table">
        <table>
          <thead>
            <tr>
              <th>Venda #</th>
              <th>Valor Total</th>
              <th>Forma de Pagamento</th>
              <th>Data da Venda</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            {vendas.map((venda) => (
              <tr key={venda.id_venda}>
                <td>{venda.id_venda}</td>
                <td>R$ {venda.valor_total.toFixed(2)}</td>
                <td>{venda.forma_pagamento}</td>
                <td>{new Intl.DateTimeFormat('pt-BR', { dateStyle: 'short', timeStyle: 'short' }).format(new Date(venda.data_criacao))}</td>
                <td>
                  <Link to={`/venda-concluida/${venda.id_venda}`} className="btn-view-sale">Visualizar</Link>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default VendasConcluidas;