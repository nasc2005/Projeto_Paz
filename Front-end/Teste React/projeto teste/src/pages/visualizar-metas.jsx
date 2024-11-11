// src/pages/VisualizarMetas.jsx
import React, { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom'; // Para navegação entre páginas
import '../styles/visualizar-metas.css'; // Arquivo CSS da página
import { readMetas } from '../services/api-metas';

function VisualizarMetas() {
  const [metas, setMetas] = useState([]);

  // Função para buscar usuários
  async function getMetas() {
    const response = await readMetas();
    setMetas(response);
  
  }

  useEffect(() => {
    getMetas();
  }, []);

  const navigate = useNavigate();

  // Função para redirecionar para a página de criar meta
  const handleAddMetaClick = () => {
    navigate('/criar-metas'); // Redireciona para a página de cadastro de comunidade
  };

  return (
    <div className="container">
      <header>
        <h1>Metas da Instituição</h1>
      </header>

      <div className="meta-section">
        <ul>
          {metas.map((meta) => (
            <li key={meta.id_meta}>
              <div className="meta">
                <p>{meta.nome}</p>
                <Link to={`/meta-detalhes/${meta.id_meta}`} className="btn-view">Ver Meta</Link>
              </div>
            </li>
          ))}
        </ul>
      </div>

      <button className="btn-add-place" onClick={handleAddMetaClick}>
        Adicionar Meta
      </button>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default VisualizarMetas;