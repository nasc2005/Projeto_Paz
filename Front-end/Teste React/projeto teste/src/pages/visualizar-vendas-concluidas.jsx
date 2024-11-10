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

      <div className="sales-list">
        <ul>
          {vendas.map((venda) => (
            <li key={venda.id_venda}>
              <span>
                Venda #{venda.id_venda} - R$ {venda.valor_total} - {venda.forma_pagamento} - {venda.data_criacao} - 
              </span>
              <Link to={`/venda-concluida/${venda.id_venda}`} className="btn-view-sale">
                Visualizar
              </Link>
            </li>
          ))}
        </ul>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default VendasConcluidas;
