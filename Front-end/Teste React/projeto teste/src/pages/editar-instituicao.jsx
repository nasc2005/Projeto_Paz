// src/pages/EditarInstituicao.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Para notificações
import '../styles/editar-instituicao.css';

function EditarInstituicao() {
  // Estado inicial com valores preenchidos
  const [instituicao, setInstituicao] = useState({
    nome: 'Instituição Exemplo',
    endereco: 'Rua ABC, 123',
    cnpj: '12.345.678/0001-90',
  });

  const [loading, setLoading] = useState(false); // Controle de estado para carregamento
  const [formValid, setFormValid] = useState(true); // Controle de validade do formulário

  // Função para lidar com as mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setInstituicao({ ...instituicao, [name]: value });
  };

  // Função para validar o formulário
  const validateForm = () => {
    // Simples validação de CNPJ e campos obrigatórios
    const isValid = instituicao.nome && instituicao.endereco && instituicao.cnpj;
    setFormValid(isValid);
    return isValid;
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validateForm()) {
      // Se o formulário não for válido, não enviamos
      return;
    }

    setLoading(true); // Inicia o carregamento

    // Simulação de requisição para atualizar os dados
    setTimeout(() => {
      console.log('Instituição atualizada:', instituicao);

      // Exibir notificação de sucesso
      Swal.fire({
        title: 'Sucesso!',
        text: 'A instituição foi atualizada com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK',
      });

      setLoading(false); // Finaliza o carregamento
    }, 2000); // Simulação de 2 segundos para a requisição (substitua pela lógica real)
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Instituição</h1>
      </header>

      <div className="institution-form">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome da Instituição:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            value={instituicao.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="endereco">Endereço:</label>
          <input
            type="text"
            id="endereco"
            name="endereco"
            value={instituicao.endereco}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="cnpj">CNPJ:</label>
          <input
            type="text"
            id="cnpj"
            name="cnpj"
            value={instituicao.cnpj}
            onChange={handleInputChange}
            required
          />

          <button
            type="submit"
            className="btn-submit"
            disabled={loading || !formValid} // Desabilitar o botão enquanto o formulário está sendo salvo ou inválido
          >
            {loading ? 'Salvando...' : 'Atualizar Instituição'}
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EditarInstituicao;
