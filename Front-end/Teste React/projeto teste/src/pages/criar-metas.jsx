// src/pages/CriarMeta.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Para exibir alertas
import { useNavigate } from 'react-router-dom'; // Para navegação
import '../styles/criar-metas.css';
import { postMeta } from '../services/api-metas';

function CriarMeta() {
  const [meta, setMeta] = useState({
    id_lugar: 1,
    id_usuarioCriador: 1,
    nome: '',
    valor: '',
    marca: '',
    imagem: '' // Armazenar URL da imagem para pré-visualização
  });

  const [loading, setLoading] = useState(false); // Estado para controle de carregamento
  const [previewImage, setPreviewImage] = useState(null);
  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value, files } = e.target;
    if (name === 'imagem' && files[0]) {
      const imageFile = files[0];
      setMeta({ ...meta, [name]: imageFile });
      setPreviewImage(URL.createObjectURL(imageFile)); // Mostrar pré-visualização da imagem
    } else {
      setMeta({ ...meta, [name]: value });
    }
  };

  // Função para adicionar uma nova meta
  const addMeta = async () => {
    const novoMeta = {
      id_instituicao: meta.id_instituicao,
      apelido: meta.apelido,
      endereco: meta.endereco,
      numero: meta.numero,
      arranjo: meta.arranjo,
    };
  
    try {
      await postMeta(novoMeta);
      Swal.fire({
        title: 'Meta Cadastrada!',
        text: 'A meta foi cadastrada com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar para a página de listagem de metas (ou qualquer outra página)
        navigate('/visualizar-metas');
      });
      
      // Resetar o formulário após o envio (opcional)
      setMeta({ nome: '', valor: '', marca: '', imagem: '' });
    } catch (error) {
      console.error("Erro ao cadastrar meta:", error);
      Swal.fire({
        title: 'Erro!',
        text: 'Não foi possível cadastrar a meta.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    addMeta(); // Chama a função para salvar os dados
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

          <label htmlFor="valor">Valor:</label>
          <input
            type="number"
            id="valor"
            name="valor"
            value={meta.valor}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="marca">Marca do produto:</label>
          <input
            type="text"
            id="marca"
            name="marca"
            value={meta.marca}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="imagem">Imagem do produto:</label>
          <input
            type="file"
            id="imagem"
            name="imagem"
            accept="image/*"
            onChange={handleInputChange}
          />
          {previewImage && <img src={previewImage} alt="Pré-visualização" style={{ width: '100px', marginTop: '10px' }} />}


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