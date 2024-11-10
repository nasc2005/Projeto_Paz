// src/pages/DetalhesMeta.jsx
import React, { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import '../styles/meta-detalhes.css';  // Certifique-se de ter o arquivo CSS correspondente
import { readMetaById } from '../services/api-metas';

function DetalhesMeta() {
  const { id } = useParams();
  
  const [meta, setMeta] = useState(null);

  // Função para buscar venda
  async function getMeta() {
      const response = await readMetaById(id);
      setMeta(response);
  }

  useEffect(() => {
    getMeta();
  }, [id]);

  const navigate = useNavigate();

  // Função para lidar com o encerramento da meta
  const handleEncerrarMeta = () => {
    alert("Meta encerrada!");
  };

  // Função para redirecionar para a página de criar meta
  const handleEditarMeta = () => {
    navigate(`/editar-meta/${meta.id_meta}`); // Redireciona para a página de cadastro de comunidade
  };

  return (
    <div className="container">
      <header>
        <h1>Detalhes da Meta</h1>
      </header>
      {meta ? (
        <div className="meta-details">
          <h2>{meta.nome || ''}</h2>
          <p><strong>Valor: R$ </strong> {meta.valor || ''}</p>
          <p><strong>Progresso Atual:</strong> trabalhando nisso</p>
          <p><strong>Data de Início:</strong> {meta.data_criacao || ''}</p>
          <p><strong>Data de Término:</strong> trabalhando nisso</p>
          <p><strong>Status:</strong> {meta.status_meta || ''}</p>

          <div className="actions">
            <button className="btn-edit" onClick={handleEditarMeta}>Editar Meta</button>
            <button className="btn-close" onClick={handleEncerrarMeta}>Encerrar Meta</button>
          </div>
        </div>
      ) : (
        <p>Carregando detalhes da venda...</p>
      )}

      

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default DetalhesMeta;