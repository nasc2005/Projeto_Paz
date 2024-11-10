// src/pages/VisualizarMetas.jsx
import { React, useEffect, useState } from 'react';
import { Link } from 'react-router-dom'; // Para navegação entre páginas
import '../styles/visualizar-metas.css'; // Arquivo CSS da página
import { getFunction } from '../services/api-metas';

function VisualizarMetas() {
  const [metas, setMetas] = useState([]);

  // Função para buscar usuários
  async function getMetas() {
    const response = await getFunction();
    setMetas(response);
  
  }

  useEffect(() => {
    getMetas();
  }, []);

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
                <Link to={meta.link} className="btn-view">Ver Meta</Link>
              </div>
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

export default VisualizarMetas;
