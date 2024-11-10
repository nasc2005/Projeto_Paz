// src/pages/DetalhesMeta.jsx
import React from 'react';
import '../styles/meta-detalhes.css';  // Certifique-se de ter o arquivo CSS correspondente

function DetalhesMeta() {
  const meta = {
    nome: "Meta de Vendas - Janeiro",
    objetivo: "Atingir R$ 10.000 em vendas no mês de Janeiro.",
    progresso: "R$ 6.500",
    dataInicio: "01/01/2024",
    dataTermino: "31/01/2024",
    status: "Em andamento"
  };

  // Função para lidar com o encerramento da meta
  const handleEncerrarMeta = () => {
    alert("Meta encerrada!");
  };

  // Função para redirecionar para a página de edição da meta
  const handleEditarMeta = () => {
    window.location.href = 'editar-meta.html';
  };

  return (
    <div className="container">
      <header>
        <h1>Detalhes da Meta</h1>
      </header>

      <div className="meta-details">
        <h2>{meta.nome}</h2>
        <p><strong>Objetivo:</strong> {meta.objetivo}</p>
        <p><strong>Progresso Atual:</strong> {meta.progresso}</p>
        <p><strong>Data de Início:</strong> {meta.dataInicio}</p>
        <p><strong>Data de Término:</strong> {meta.dataTermino}</p>
        <p><strong>Status:</strong> {meta.status}</p>

        <div className="actions">
          <button className="btn-edit" onClick={handleEditarMeta}>Editar Meta</button>
          <button className="btn-close" onClick={handleEncerrarMeta}>Encerrar Meta</button>
        </div>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default DetalhesMeta;
