// src/pages/CadastroInstituicao.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/cadastroInstituicao.css';
import { postInstituicao } from '../services/api-instituicoes';

function CadastroInstituicao() {
  // Estado para armazenar os dados do formulário
  const [instituicao, setInstituicao] = useState({
    nome: '',
    descricao: '',
    logo: '',
    saldo: ''
  });

  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setInstituicao({ ...instituicao, [name]: value });
  };

  // Função para adicionar uma nova instituição
  const addInstituicao = async () => {
    const novaInstituicao = {
      nome: instituicao.nome,
      descricao: instituicao.descricao,
      logo: instituicao.logo,
      saldo: instituicao.saldo
    };
    
    try {
      await postInstituicao(novaInstituicao);
      Swal.fire({
        title: 'Instituições Cadastrada!',
        text: 'A instituição foi cadastrada com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar para a página de cadastrar admin
        navigate('/cadastrar-adm');
      });
      
      // Resetar o formulário após o envio (opcional)
      setInstituicao({ nome: '', descricao: '', logo: '', saldo: '' });
    } catch (error) {
      console.error("Erro ao cadastrar instituição:", error);
      Swal.fire({
        title: 'Erro!',
        text: 'Não foi possível cadastrar a instituição.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    addInstituicao(); // Chama a função para salvar os dados
  };

  return (
    <div className="container">
      <header>
        <h1>Cadastro de Instituição</h1>
      </header>

      <div className="form-box">
        <h2>Insira os dados da Instituição</h2>
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome da Instituição</label>
          <input
            type="text"
            id="nome"
            name="nome"
            placeholder="Digite o nome da instituição"
            value={instituicao.nome}
            onChange={handleInputChange}
            required
          />
          
          <label htmlFor="descricao">Descrição</label>
          <input
            type="text"
            id="descricao"
            name="descricao"
            placeholder="Digite a descrição da instituição"
            value={instituicao.descricao}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="logo">Logo</label>
          <input
            type="text"
            id="logo"
            name="logo"
            placeholder="Insira a logo da instituição"
            value={instituicao.logo}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="saldo">Saldo</label>
          <input
            type="number"
            id="saldo"
            name="saldo"
            value={instituicao.saldo}
            onChange={handleInputChange}
            required
          />

          <button type="submit">Cadastrar Instituição</button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default CadastroInstituicao;