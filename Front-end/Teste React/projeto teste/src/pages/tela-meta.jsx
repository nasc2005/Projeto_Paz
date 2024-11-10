// src/pages/TelaMeta.jsx
import React from 'react';
import { useNavigate } from 'react-router-dom'; // Importa o hook useNavigate
import '../styles/tela-meta.css'; // Certifique-se de ter o arquivo CSS correspondente

function TelaMeta() {
  // Dados da meta (pode vir de props ou de uma API em casos reais)
  const meta = {
    nome: "Meta de Vendas - Janeiro",
    descricao: "Aumentar as vendas em 20% durante o mês de Janeiro.",
    prazo: "31 de Janeiro de 2024",
  };

  const navigate = useNavigate(); // Inicializa o hook de navegação

  // Função para redirecionar para a página de edição de meta
  const handleEditarMeta = () => {
    navigate('/editar-meta'); // Navega para a página de edição de meta
  };

  return (
    <div className="container">
      <header>
        <h1>Detalhes da Meta</h1>
      </header>

      <div className="meta-details">
        <p><strong>Nome:</strong> {meta.nome}</p>
        <p><strong>Descrição:</strong> {meta.descricao}</p>
        <p><strong>Prazo:</strong> {meta.prazo}</p>
        <button className="btn-edit" onClick={handleEditarMeta}>Editar Meta</button>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default TelaMeta;
