// src/pages/EditarComunidade.jsx
import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2';
import { useNavigate, useParams } from 'react-router-dom';
import '../styles/editar-comunidade.css';
import { readLugarById, putLugar, deleteLugar } from '../services/api-lugares';

function EditarComunidade() {
  const { id } = useParams(); // Obter o `id` da URL
  const navigate = useNavigate();

  const [comunidade, setComunidade] = useState({
    id_lugar: id,
    id_instituicao: '',
    apelido: '',
    endereco: '',
    numero: '',
    arranjo: ''
  });
  const [isLoading, setIsLoading] = useState(false);

  // Função para buscar os dados do lugar com base no `id`
  useEffect(() => {
    async function fetchLugar() {
      try {
        const lugar = await readLugarById(id); // Busca os dados usando o `id`
        setComunidade(lugar); // Preenche o estado com os dados recebidos
      } catch (error) {
        console.error("Erro ao buscar o lugar:", error);
      }
    }
    fetchLugar();
  }, [id]);

  if (isLoading) return <div>Carregando...</div>; // Exibe "Carregando" enquanto busca dados


  // Função para lidar com mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setComunidade({ ...comunidade, [name]: value });
  };

  // Função para atualizar a comunidade
  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      await putLugar(comunidade); // Atualiza os dados do lugar
      Swal.fire({
        title: 'Comunidade Atualizada!',
        text: 'As informações da comunidade foram atualizadas com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => navigate('/visualizar-lugares'));
    } catch (error) {
      console.error("Erro ao atualizar a comunidade:", error);
    } finally {
      setIsLoading(false);
    }
  };

  // Função para excluir a comunidade com confirmação
  const handleDelete = () => {
    Swal.fire({
      title: 'Tem certeza?',
      text: 'Você não poderá reverter isso!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar',
    }).then(async (result) => {
      if (result.isConfirmed) {
        try {
          await deleteLugar(id); // Exclui o lugar
          Swal.fire({
            title: 'Comunidade Excluída!',
            text: 'A comunidade foi excluída com sucesso.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => navigate('/visualizar-lugares'));
        } catch (error) {
          console.error("Erro ao excluir a comunidade:", error);
        }
      }
    });
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Comunidade</h1>
      </header>

      <div className="community-form">
        <form onSubmit={handleSubmit}>
          <label htmlFor="apelido">Apelido da Comunidade:</label>
          <input
            type="text"
            id="apelido"
            name="apelido"
            value={comunidade.apelido || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="endereco">Localização:</label>
          <input
            type="text"
            id="endereco"
            name="endereco"
            value={comunidade.endereco || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="numero">Número:</label>
          <input
            type="text"
            id="numero"
            name="numero"
            value={comunidade.numero || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="arranjo">Arranjo:</label>
          <input
            type="text"
            id="arranjo"
            name="arranjo"
            value={comunidade.arranjo || ''}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit" disabled={isLoading}>
            {isLoading ? 'Atualizando...' : 'Atualizar Comunidade'}
          </button>
        </form>

        <button
          type="button"
          className="btn-delete"
          onClick={handleDelete}
          disabled={isLoading}
        >
          {isLoading ? 'Excluindo...' : 'Excluir Comunidade'}
        </button>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EditarComunidade;