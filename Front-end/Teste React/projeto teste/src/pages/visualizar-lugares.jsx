import React, { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import '../styles/visualizar-lugares.css';
import { readLugares } from '../services/api-lugares';

function VisualizarLugares() {
  const [lugares, setLugares] = useState([]);

  // Função para buscar lugares
  async function getLugares() {
    const response = await readLugares();
    setLugares(response);
  }

  useEffect(() => {
    getLugares();
  }, []);

  const navigate = useNavigate();

  const handleAddPlaceClick = () => {
    navigate('/cadastrar-comunidade'); // Redireciona para a página de cadastro de comunidade
  };

  return (
    <div className="container">
      <header>
        <h1>Lugares Cadastrados</h1>
      </header>

      <div className="place-list">
        <ul>
          {lugares.map((lugar) => (
            <li key={lugar.id_lugar}>
              <Link to={`/editar-comunidade/${lugar.id_lugar}`}>
                {lugar.apelido}
              </Link>
              - {lugar.arranjo} - {lugar.endereco} - {lugar.numero}
            </li>
          ))}
        </ul>
      </div>

      <button className="btn-add-place" onClick={handleAddPlaceClick}>
        Adicionar Comunidade
      </button>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default VisualizarLugares;