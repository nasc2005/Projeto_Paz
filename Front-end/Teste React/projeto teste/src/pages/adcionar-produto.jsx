// src/pages/AdicionarProduto.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/adicionar-produto.css';
import { postProduto } from '../services/api-produtos';

function AdicionarProduto() {
  const [produto, setProduto] = useState({
    nome: '', 
    valor_custo: '',
    imagem: '',
    categoria: '',
    valor_venda: '',
    descricao: '',
    estoque: ''
  });
  
  const [loading, setLoading] = useState(false); // Estado para controle de carregamento
  const [previewImage, setPreviewImage] = useState(null);
  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
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

  // Função para adicionar um novo Produto
  const addProduto = async () => {
    const novoProduto = {
      nome: produto.nome, 
      valor_custo: produto.valor_custo,
      categoria: produto.categoria,
      valor_venda: produto.valor_venda,
      descricao: produto.descricao, 
      estoque: produto.estoque
    };
  
    try {
      await postProduto(novoProduto);
      Swal.fire({
        title: 'Produto Cadastrado!',
        text: 'O produto foi cadastrado com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Redirecionar para a página de listagem de Produtos (ou qualquer outra página)
        navigate('/visualizar-estoque');
      });
      
      // Resetar o formulário após o envio (opcional)
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
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    addProduto(); // Chama a função para salvar os dados
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
            name="custo"
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

          <label htmlFor="quantidade">Quantidade:</label>
          <input
            type="number"
            id="estoque"
            name="quantidade"
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