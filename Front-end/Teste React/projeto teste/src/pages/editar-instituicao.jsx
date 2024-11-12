// src/pages/EditarInstituicao.jsx
import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2'; // Para notificações
import { useNavigate, useParams } from 'react-router-dom';
import '../styles/editar-instituicao.css';
import { readInstituicaoById, putInstituicao } from '../services/api-instituicoes';

function EditarInstituicao() {
  const { id } = useParams(); // Obter o `id` da URL
  const navigate = useNavigate();

  // Estado para armazenar os dados do formulário
  const [instituicao, setInstituicao] = useState({
    id_instituicao: id,
    nome: '',
    descricao: '',
    logo: '',
    saldo: ''
  });

  const [isLoading, setIsLoading] = useState(false);

  // Função para buscar os dados da instituição com base no `id`
  useEffect(() => {
    async function fetchInstituicao() {
      try {
        const instituicao = await readInstituicaoById(id); // Busca os dados usando o `id`
        setInstituicao(instituicao); // Preenche o estado com os dados recebidos
      } catch (error) {
        console.error("Erro ao buscar o instituicao:", error);
      }
    }
    fetchInstituicao();
  }, [id]);

  if (isLoading) return <div>Carregando...</div>; // Exibe "Carregando" enquanto busca dados


  // Função para lidar com mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setInstituicao({ ...instituicao, [name]: value });
  };

  // Função para atualizar a instituição
  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      await putInstituicao(instituicao); // Atualiza os dados do instituicao
      Swal.fire({
        title: 'Instituição Atualizada!',
        text: 'As informações da instituição foram atualizadas com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => navigate('/visualizar-estatisticas'));
    } catch (error) {
      console.error("Erro ao atualizar a instituição:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Instituição</h1>
      </header>

      <div className="institution-form">
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

          <button type="submit" className="btn-submit" disabled={isLoading}>
            {isLoading ? 'Atualizando...' : 'Atualizar Instituição'}
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