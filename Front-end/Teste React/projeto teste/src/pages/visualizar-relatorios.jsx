// src/pages/VisualizarRelatorios.jsx
import React from 'react';
import { Link } from 'react-router-dom'; // Para navegação entre páginas
import '../styles/visualizar-relatorios.css'; // Arquivo CSS da página

function VisualizarRelatorios() {
  const relatorios = [
    { nome: 'Relatório de Venda 1', link: '/venda-concluida' },
    { nome: 'Relatório de Venda 2', link: '/venda-concluida' },
    { nome: 'Relatório de Venda 3', link: '/venda-concluida' }
  ];

  return (
    <div className="container">
      <header>
        <h1>Relatórios de Vendas</h1>
      </header>

      <div className="report-list">
        <ul>
          {relatorios.map((relatorio, index) => (
            <li key={index}>
              <Link to={relatorio.link}>{relatorio.nome}</Link>
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

export default VisualizarRelatorios;
