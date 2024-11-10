// src/pages/CadastroAdm.jsx
import React, { useState } from 'react';
import '../styles/cadAdm.css';

function CadastroAdm() {
  // Estado para armazenar os dados do formulário
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: ''
  });

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { id, value } = e.target;
    setFormData({
      ...formData,
      [id]: value
    });
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault(); // Evita o comportamento padrão do envio do formulário

    // Aqui você pode adicionar a lógica de envio para o backend ou API
    console.log(formData); // Para depuração

    // Após o envio, redireciona para outra página, se necessário
    // window.location.href = '/alguma-rota';
  };

  return (
    <div className="container">
      <header>
        <h1>Cadastro de ADM</h1>
      </header>

      <div className="form-box">
        <h2>Insira os dados do ADM</h2>
        <form onSubmit={handleSubmit}>
          <label htmlFor="name">Nome do ADM</label>
          <input
            type="text"
            id="name"
            placeholder="Digite o nome do administrador"
            value={formData.name}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="email">E-mail</label>
          <input
            type="email"
            id="email"
            placeholder="Digite o e-mail"
            value={formData.email}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="password">Senha</label>
          <input
            type="password"
            id="password"
            placeholder="Digite a senha"
            value={formData.password}
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
