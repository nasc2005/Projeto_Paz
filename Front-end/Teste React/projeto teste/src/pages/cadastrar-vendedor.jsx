// src/pages/CadastrarVendedor.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/cadastrar-vendedor.css';
import { postUsuario } from '../services/api-usuarios';

function CadastrarVendedor() {
  const [vendedor, setVendedor] = useState({
    id_instituicao: 1,
    nome: '',
    email: '',
    telefone: '',
    senha: '',
    cpf: '',
    perfil: 'Vendedor',
    data_nasc: '',
    imagem: ''
  });

  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setVendedor({ ...vendedor, [name]: value });
  };

  // Função para adicionar um novo usuário
  const addUsuario = async () => {
    const novoUsuario = {
      id_instituicao: vendedor.id_instituicao,
      nome: vendedor.nome,
      email: vendedor.email,
      telefone: vendedor.telefone,
      senha: vendedor.senha,
      cpf: vendedor.cpf,
      perfil: vendedor.perfil,
      data_nasc: vendedor.data_nasc,
      imagem: vendedor.imagem
    };
    
    try {
      await postUsuario(novoUsuario);
      Swal.fire({
        title: 'Vendedor Cadastrado!',
        text: 'O vendedor foi cadastrado com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar para a página de listagem de usuários
        navigate('/visualizar-estatisticas');
      });
      
      // Resetar o formulário após o envio (opcional)
      setVendedor({ nome: '', email: '', telefone: '', senha: '', cpf: '',  data_nasc: '', imagem: '' });
    } catch (error) {
      console.error("Erro ao cadastrar vendedor:", error);
      Swal.fire({
        title: 'Erro!',
        text: 'Não foi possível cadastrar o vendedor.',
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
        <h1>Cadastrar Vendedor</h1>
      </header>

      <div className="form-section">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome Completo:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            placeholder="Nome do Vendedor"
            value={vendedor.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="email">Email:</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Email do Vendedor"
            value={vendedor.email}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="senha">Senha:</label>
          <input
            type="password"
            id="senha"
            name="senha"
            placeholder="Senha"
            value={vendedor.senha}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="cpf">CPF:</label>
          <input
            type="text"
            id="cpf"
            name="cpf"
            placeholder="CPF do Vendedor"
            value={vendedor.cpf}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="telefone">Telefone:</label>
          <input
            type="text"
            id="telefone"
            name="telefone"
            placeholder="Telefone do Vendedor"
            value={vendedor.telefone}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="data_nasc">Data Nascimento:</label>
          <input
            type="date"
            id="data_nasc"
            name="data_nasc"
            placeholder="Data de Nascimento do Vendedor"
            value={vendedor.data_nasc}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="imagem">Foto de Perfil:</label>
          <input
            type="text"
            id="imagem"
            name="imagem"
            placeholder="Foto do Vendedor"
            value={vendedor.imagem}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit">
            Cadastrar Vendedor
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default CadastrarVendedor;