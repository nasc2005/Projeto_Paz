// src/pages/CadastrarComunidade.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/cadastrar-comunidade.css';
import { postLugar } from '../services/api-lugares';

function CadastrarComunidade() {
  const [community, setCommunity] = useState({
    id_instituicao: 1,
    apelido: '',
    endereco: '',
    numero: '',
    arranjo: ''
  });

  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setCommunity({ ...community, [name]: value });
  };

  // Função para adicionar um novo lugar (comunidade)
  const addLugar = async () => {
    const novoLugar = {
      id_instituicao: community.id_instituicao,
      apelido: community.apelido,
      endereco: community.endereco,
      numero: community.numero,
      arranjo: community.arranjo,
    };
    
    try {
      await postLugar(novoLugar);
      Swal.fire({
        title: 'Comunidade Cadastrada!',
        text: 'A comunidade foi cadastrada com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar para a página de listagem de comunidades
        navigate('/visualizar-lugares');
      });
      
      // Resetar o formulário após o envio
      setCommunity({ apelido: '', endereco: '', numero: '', arranjo: '' });
    } catch (error) {
      console.error("Erro ao cadastrar comunidade:", error);
      Swal.fire({
        title: 'Erro!',
        text: 'Não foi possível cadastrar a comunidade.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    addLugar(); // Chama a função para salvar os dados
  };

  return (
    <div className="container">
      <header>
        <h1>Cadastrar Comunidade</h1>
      </header>

      <div className="community-form">
        <form onSubmit={handleSubmit}>
          <label htmlFor="apelido">Apelido da Comunidade:</label>
          <input
            type="text"
            id="apelido"
            name="apelido"
            value={community.apelido}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="endereco">Localização:</label>
          <input
            type="text"
            id="endereco"
            name="endereco"
            value={community.endereco}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="numero">Número:</label>
          <input
            type="text"
            id="numero"
            name="numero"
            value={community.numero}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="arranjo">Arranjo:</label>
          <input
            type="text"
            id="arranjo"
            name="arranjo"
            value={community.arranjo}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit">
            Salvar Comunidade
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default CadastrarComunidade;