// src/pages/CadastroAdm.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/cadAdm.css';
import { postUsuario } from '../services/api-usuarios';

function CadastroAdm() {
  // Estado para armazenar os dados do formulário
  const [admin, setAdmin] = useState({
    id_instituicao: 1,
    nome: '',
    telefone: '',
    email: '',
    senha: '',
    cpf: '',
    perfil: 'Administrador',
    data_nasc: '',
    imagem: ''
  });

  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setAdmin({ ...admin, [name]: value });
  };

  // Função para adicionar um novo usuário
  const addUsuario = async () => {
    const novoUsuario = {
      id_instituicao: admin.id_instituicao,
      nome: admin.nome,
      telefone: admin.telefone,
      email: admin.email,
      senha: admin.senha,
      cpf: admin.cpf,
      perfil: admin.perfil,
      data_nasc: admin.data_nasc,
      imagem: admin.imagem
    };
    
    try {
      await postUsuario(novoUsuario);
      Swal.fire({
        title: 'Administrador Cadastrado!',
        text: 'O administrador foi cadastrado com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar para a página de listagem de usuários
        navigate('/visualizar-estatisticas');
      });
      
      // Resetar o formulário após o envio (opcional)
      setAdmin({ nome: '', email: '', telefone: '', senha: '', cpf: '',  data_nasc: '', imagem: '' });
    } catch (error) {
      console.error("Erro ao cadastrar adm:", error);
      Swal.fire({
        title: 'Erro!',
        text: 'Não foi possível cadastrar o adm.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    addUsuario(); // Chama a função para salvar os dados
  };

  return (
    <div className="container">
      <header>
        <h1>Cadastro de ADM</h1>
      </header>

      <div className="form-box">
        <h2>Insira os dados do ADM</h2>
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome do ADM</label>
          <input
            type="text"
            id="nome"
            name="nome"
            placeholder="Digite o nome do administrador"
            value={admin.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="email">E-mail</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Digite o e-mail"
            value={admin.email}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="senha">Senha</label>
          <input
            type="password"
            id="senha"
            name="senha"
            placeholder="Digite a senha"
            value={admin.senha}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="cpf">CPF:</label>
          <input
            type="text"
            id="cpf"
            name="cpf"
            placeholder="Digite o CPF"
            value={admin.cpf}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="telefone">Telefone:</label>
          <input
            type="text"
            id="telefone"
            name="telefone"
            placeholder="Digite o Telefone"
            value={admin.telefone}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="data_nasc">Data Nascimento:</label>
          <input
            type="date"
            id="data_nasc"
            name="data_nasc"
            value={admin.data_nasc}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="imagem">Foto de Perfil:</label>
          <input
            type="text"
            id="imagem"
            name="imagem"
            placeholder="Foto do adm"
            value={admin.imagem}
            onChange={handleInputChange}
            required
          />

          <button type="submit">Cadastrar ADM</button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default CadastroAdm;