import { React, useEffect, useState } from 'react';
import { Link } from 'react-router-dom'; // Importar Link do React Router
import '../styles/visualizar-estatisticas.css'; // Importe o arquivo CSS para este componente
import { getFunction } from '../services/api-usuarios';

function Estatisticas() {
  const [usuarios, setUsuarios] = useState([]);

  // Função para buscar usuários
  async function getUsers() {
    const response = await getFunction();
    setUsuarios(response);
  
  }

  useEffect(() => {
    getUsers();
  }, []);

  return (
    <div className="container">
      <header>
        <h1>Estatísticas da Instituição</h1>
      </header>

      <div className="statistics-section">
        <h2>Vendas Realizadas</h2>
        <p>Total de vendas: 150</p>
        <p>Total arrecadado: R$ 20.000,00</p>

        <h2>Melhor Vendedor</h2>
        <p>Nome: João da Silva</p>
        <p>Total Vendas: 50</p>
      </div>

      <div className="users-section">
        <h2>Usuários da Instituição</h2>
        <ul id="user-list">
          {/* Lista dinâmica de usuários */}
          {usuarios.map((usuario) => (
            <li key={usuario.id_usuario}>
              {usuario.nome} - 
              {usuario.perfil} - 
              {usuario.email} - 
              {usuario.telefone}
            </li>
          ))}
        </ul>
      </div>

      <div className="options-section">
        {/* Usando Link do react-router-dom para navegação sem recarregar a página */}
        <Link to="/cadastro-adm">
          <button>Cadastrar ADM</button>
        </Link>
        <Link to="/cadastrar-vendedor">
          <button>Cadastrar Vendedor</button>
        </Link>
        <Link to="/editar-instituicao">
          <button>Editar Instituição</button>
        </Link>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default Estatisticas;
