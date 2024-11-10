// src/pages/EditarProduto.jsx
import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import Swal from 'sweetalert2';
import '../styles/editar-produto.css';
import { readProdutoById, putProduto, deleteProduto } from '../services/api-produtos';

function EditarProduto() {
  const { id } = useParams();
  const navigate = useNavigate();

  // Estado inicial com valores preenchidos
  const [produto, setProduto] = useState({
    id_produto: id,
    nome: '', 
    valor_custo: '',
    imagem: '',
    categoria: '',
    valor_venda: '',
    descricao: '',
    estoque: ''
  });

  const [isLoading, setIsLoading] = useState(false);
  const [previewImage, setPreviewImage] = useState(null);

  useEffect(() => {
    async function fetchProduto() {
      try {
        const produto = await readProdutoById(id);
        setProduto(produto);
        setPreviewImage(produto.imagem); // Carregar imagem existente (se houver) na pré-visualização
      } catch (error) {
        console.error("Erro ao buscar o produto:", error);
      }
    }
    fetchProduto();
  }, [id]);

  // Função para lidar com as mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value, files } = e.target;
    if (name === 'imagem' && files[0]) {
      const imageFile = files[0];
      setProduto({ ...produto, [name]: imageFile });
      setPreviewImage(URL.createObjectURL(imageFile)); // Mostrar pré-visualização da imagem
    } else {
      setProduto({ ...produto, [name]: value });
    }
  };

  // Função para lidar com a submissão do formulário
  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      // Preparar dados para envio (pode incluir lógica de upload de imagem aqui)
      await putProduto(produto);
      Swal.fire({
        title: 'Produto Atualizada!',
        text: 'As informações do produto foram atualizadas com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => navigate('/visualizar-estoque'));
    } catch (error) {
      console.error("Erro ao atualizar o produto:", error);
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
          await deleteProduto(id);
          Swal.fire({
            title: 'Produto Excluído!',
            text: 'O produto foi excluída com sucesso.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => navigate('/visualizar-estoque'));
        } catch (error) {
          console.error("Erro ao excluir o produto:", error);
        }
      }
    });
  };

  // Função para notificar a falta de produto
  const notifyProductShortage = () => {
    Swal.fire({
      title: 'Falta de Produto!',
      text: 'Notificação de falta de produto enviada com sucesso.',
      icon: 'warning',
      confirmButtonText: 'OK',
    });
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Produto</h1>
      </header>

      <div className="product-form">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome do Produto:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            value={produto.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="descricao">Descrição:</label>
          <textarea
            id="descricao"
            name="descricao"
            value={produto.descricao}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="categoria">Categoria:</label>
          <input
            type="text"
            id="categoria"
            name="categoria"
            value={produto.categoria}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="valor_custo">Custo:</label>
          <input
            type="number"
            id="valor_custo"
            name="valor_custo"
            value={produto.valor_custo}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="valor_venda">Valor de Venda:</label>
          <input
            type="number"
            id="valor_venda"
            name="valor_venda"
            value={produto.valor_venda}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="estoque">Quantidade:</label>
          <input
            type="number"
            id="estoque"
            name="estoque"
            value={produto.estoque}
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
            Atualizar Produto
          </button>
          <button type="button" className="btn-delete" onClick={handleDelete}>
            Excluir Produto
          </button>
          <button
            type="button"
            className="btn-submit"
            onClick={notifyProductShortage}
          >
            Notificar Falta de Produto
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EditarProduto;