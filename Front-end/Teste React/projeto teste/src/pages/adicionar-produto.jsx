import React, { useState } from 'react';
import Swal from 'sweetalert2';
import { useNavigate } from 'react-router-dom';
import '../styles/adicionar-produto.css';
import { postProduto } from '../services/api-produtos';

function AdicionarProduto() {
  const [produto, setProduto] = useState({
    nome: '', 
    valor_custo: '',
    imagem: 'teste',
    categoria: '',
    valor_venda: '',
    descricao: '',
    estoque: ''
  });
  
  const [loading, setLoading] = useState(false);
  const [previewImage, setPreviewImage] = useState(null);
  const navigate = useNavigate();

  const handleInputChange = (e) => {
    const { name, value, files } = e.target;
    if (name === 'imagem' && files[0]) {
      const imageFile = files[0];
      setProduto({ ...produto, [name]: imageFile });
      setPreviewImage(URL.createObjectURL(imageFile));
    } else {
      setProduto({ ...produto, [name]: value });
    }
  };

  const addProduto = async () => {
    setLoading(true);
    const novoProduto = {
      nome: produto.nome, 
      valor_custo: produto.valor_custo,
      categoria: produto.categoria,
      valor_venda: produto.valor_venda,
      descricao: produto.descricao, 
      estoque: produto.estoque
    };

    // Adicione a imagem apenas se ela existir
    if (produto.imagem) {
      novoProduto.imagem = produto.imagem;
    } 
  
    try {
      await postProduto(novoProduto);
      Swal.fire({
        title: 'Produto Cadastrado!',
        text: 'O produto foi cadastrado com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        navigate('/visualizar-estoque');
      });
      setProduto({ nome: '', valor_custo: '', imagem: '', categoria: '', valor_venda: '', descricao: '', estoque: '' });
    } catch (error) {
      console.error("Erro ao cadastrar produto:", error);
      Swal.fire({
        title: 'Erro!',
        text: 'Não foi possível cadastrar o produto.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
    setLoading(false);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    addProduto();
  };

  return (
    <div className="container">
      <header>
        <h1>Adicionar Produto</h1>
      </header>

      <div className="produto-form">
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

          <button type="submit" className="btn-submit" disabled={loading}>
            {loading ? 'Salvando...' : 'Salvar Produto'}
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default AdicionarProduto;