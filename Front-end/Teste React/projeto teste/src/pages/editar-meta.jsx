import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import '../styles/editar-meta.css';
import { readMetaById, putMeta, deleteMeta } from '../services/api-metas';

function EditarMeta() {
  const { id } = useParams();
  const navigate = useNavigate();

  const [meta, setMeta] = useState({
    id_meta: id,
    id_lugar: '',
    id_usuarioCriador: '',
    nome: '',
    valor: '',
    marca: '',
    imagem: '', // Armazenar URL da imagem para pré-visualização
    status_meta: ''
  });

  const [isLoading, setIsLoading] = useState(false);
  const [previewImage, setPreviewImage] = useState(null);

  useEffect(() => {
    async function fetchMeta() {
      try {
        const meta = await readMetaById(id);
        setMeta(meta);
        setPreviewImage(meta.imagem); // Carregar imagem existente (se houver) na pré-visualização
      } catch (error) {
        console.error("Erro ao buscar a meta:", error);
      }
    }
    fetchMeta();
  }, [id]);

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

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      // Preparar dados para envio (pode incluir lógica de upload de imagem aqui)
      await putMeta(meta);
      Swal.fire({
        title: 'Meta Atualizada!',
        text: 'As informações da meta foram atualizadas com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => navigate('/visualizar-metas'));
    } catch (error) {
      console.error("Erro ao atualizar a meta:", error);
    } finally {
      setIsLoading(false);
    }
  };

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
          await deleteMeta(id);
          Swal.fire({
            title: 'Meta Excluída!',
            text: 'A meta foi excluída com sucesso.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => navigate('/visualizar-metas'));
        } catch (error) {
          console.error("Erro ao excluir a meta:", error);
        }
      }
    });
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Meta</h1>
      </header>

      <div className="form-section">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome da Meta:</label>
          <input
            type="text"
            id="nome"
            name="nome"
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

          <button type="submit" className="btn-submit">
            Salvar Alterações
          </button>
          <button
            type="button"
            className="btn-close"
            onClick={handleDelete}
          >
            Encerrar Meta
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EditarMeta;