// src/pages/CadastroInstituicao.jsx
import React, { useState } from 'react';
import '../styles/cadastroInstituicao.css';

function CadastroInstituicao() {
  // Estado para armazenar os dados do formulário
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    cnpj: '',
    phone: '',
    address: ''
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

    // Após o envio, redireciona para a página de cadastro de ADM
    window.location.href = '/cadastro-adm'; // Supondo que a página de cadastro de ADM seja uma rota
  };

  return (
    <div className="container">
      <header>
        <h1>Cadastro de Instituição</h1>
      </header>

      <div className="form-box">
        <h2>Insira os dados da Instituição</h2>
        <form onSubmit={handleSubmit}>
          <label htmlFor="institution-name">Nome da Instituição</label>
          <input
            type="text"
            id="name"
            placeholder="Digite o nome da instituição"
            value={formData.name}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="institution-email">E-mail</label>
          <input
            type="email"
            id="email"
            placeholder="Digite o e-mail"
            value={formData.email}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="institution-cnpj">CNPJ</label>
          <input
            type="text"
            id="cnpj"
            placeholder="Digite o CNPJ"
            value={formData.cnpj}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="institution-phone">Telefone</label>
          <input
            type="tel"
            id="phone"
            placeholder="Digite o telefone"
            value={formData.phone}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="institution-address">Endereço</label>
          <input
            type="text"
            id="address"
            placeholder="Digite o endereço"
            value={formData.address}
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
