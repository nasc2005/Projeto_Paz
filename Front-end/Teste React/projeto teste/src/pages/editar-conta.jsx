// src/pages/EditarConta.jsx
import React, { useState, useEffect } from 'react';
import Swal from 'sweetalert2'; // Para notificações
import { useNavigate, useParams } from 'react-router-dom';
import '../styles/editar-conta.css';
import { readUserById, putUsuario } from '../services/api-usuarios';

function EditarConta() {
  const { id } = useParams(); // Obter o `id` da URL
  const navigate = useNavigate();

  const [usuario, setUsuario] = useState({
    id_usuario: id,
    id_instituicao: 1,
    nome: '',
    telefone: '',
    email: '',
    cpf: '',
    perfil: '',
    data_nasc: '',
    imagem: ''
  });

  const [isLoading, setIsLoading] = useState(false);

  // Função para buscar os dados do usuario com base no `id`
  useEffect(() => {
    async function fetchUsuario() {
      try {
        const usuario = await readUserById(id); // Busca os dados usando o `id`
        setUsuario(usuario); // Preenche o estado com os dados recebidos
      } catch (error) {
        console.error("Erro ao buscar o usuario:", error);
      }
    }
    fetchUsuario();
  }, [id]);

  if (isLoading) return <div>Carregando...</div>; // Exibe "Carregando" enquanto busca dados


  // Função para lidar com mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setUsuario({ ...usuario, [name]: value });
  };

  // Função para atualizar o usuario
  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      await putUsuario(usuario); // Atualiza os dados do usuario
      Swal.fire({
        title: 'Conta Atualizada!',
        text: 'As suas informações foram atualizadas com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => navigate('/visualizar-estatisticas'));
    } catch (error) {
      console.error("Erro ao atualizar:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Conta</h1>
      </header>

      <div className="account-form">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            value={usuario.nome || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="email">E-mail:</label>
          <input
            type="email"
            id="email"
            name="email"
            value={usuario.email || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="perfil">Perfil:</label>
          <input
            type="text"
            id="perfil"
            name="perfil"
            value={usuario.perfil || ''}
            onChange={handleInputChange}
            disabled // Adiciona o atributo disabled para impedir edições
            required
          />

          <label htmlFor="cpf">CPF:</label>
          <input
            type="text"
            id="cpf"
            name="cpf"
            placeholder="CPF"
            value={usuario.cpf || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="telefone">Telefone:</label>
          <input
            type="text"
            id="telefone"
            name="telefone"
            placeholder="Telefone"
            value={usuario.telefone || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="dataNasc">Data Nascimento:</label>
          <input
            type="date"
            id="dataNasc"
            name="dataNasc"
            placeholder="Data de Nascimento"
            value={usuario.data_nasc || ''}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="imagem">Foto de Perfil:</label>
          <input
            type="text"
            id="imagem"
            name="imagem"
            placeholder="Foto de Perfil"
            value={usuario.imagem || ''}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit" disabled={isLoading}>
            {isLoading ? 'Atualizando...' : 'Atualizar Conta'}
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EditarConta;