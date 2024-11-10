// src/pages/CadastrarVendedor.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/cadastrar-vendedor.css';

function CadastrarVendedor() {
  const [vendedor, setVendedor] = useState({
    nome: '',
    email: '',
    senha: ''
  });

  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setVendedor({ ...vendedor, [name]: value });
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();

    // Aqui você pode adicionar a lógica para salvar os dados, como uma requisição para a API.
    console.log('Vendedor cadastrado:', vendedor);

    // Exibir uma notificação de sucesso
    Swal.fire({
      title: 'Vendedor Cadastrado!',
      text: 'O vendedor foi cadastrado com sucesso.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then(() => {
      // Redirecionar para a página de listagem de vendedores (ou qualquer outra página)
      navigate('/vendedores'); // Substitua '/vendedores' pelo caminho correto
    });

    // Resetar o formulário após o envio (opcional)
    setVendedor({ nome: '', email: '', senha: '' });
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
