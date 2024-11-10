// src/pages/CriarMeta.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Para exibir alertas
import { useNavigate } from 'react-router-dom'; // Para navegação
import '../styles/criar-metas.css';

function CriarMeta() {
  const [meta, setMeta] = useState({
    nome: '',
    descricao: '',
    prazo: ''
  });

  const [loading, setLoading] = useState(false); // Estado para controle de carregamento
  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setMeta({ ...meta, [name]: value });
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true); // Iniciar o carregamento

    // Aqui você pode adicionar a lógica para salvar os dados, como uma requisição para a API.
    // Vamos simular um delay de 2 segundos para ilustrar o processo de envio
    setTimeout(() => {
      console.log('Meta criada:', meta);
      
      // Exibir uma notificação de sucesso
      Swal.fire({
        title: 'Meta Criada!',
        text: 'A meta foi criada com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar após o sucesso
        navigate('/metas'); // Substitua '/metas' pela página de metas ou qualquer outra
      });

      // Resetar o formulário após o envio (opcional)
      setMeta({ nome: '', descricao: '', prazo: '' });
      setLoading(false); // Finalizar o carregamento
    }, 2000); // Simulando um atraso de 2 segundos (substitua com a lógica real de requisição)
  };

  return (
    <div className="container">
      <header>
        <h1>Criar Nova Meta</h1>
      </header>

      <div className="form-section">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome da Meta:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            placeholder="Nome da Meta"
            value={meta.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="descricao">Descrição:</label>
          <textarea
            id="descricao"
            name="descricao"
            placeholder="Descrição da Meta"
            value={meta.descricao}
            onChange={handleInputChange}
            required
          ></textarea>

          <label htmlFor="prazo">Prazo:</label>
          <input
            type="date"
            id="prazo"
            name="prazo"
            value={meta.prazo}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit" disabled={loading}>
            {loading ? 'Criando...' : 'Criar Meta'}
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default CriarMeta;
