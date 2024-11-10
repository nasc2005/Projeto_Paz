// src/pages/AdicionarProduto.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2'; // Adicionando SweetAlert2 para notificações
import { useNavigate } from 'react-router-dom'; // Importando useNavigate para navegação
import '../styles/adicionar-produto.css';

function AdicionarProduto() {
  const [product, setProduct] = useState({
    nome: '',
    preco: '',
    quantidade: ''
  });
  
  const navigate = useNavigate(); // Hook de navegação

  // Função para lidar com mudanças nos campos do formulário
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setProduct({ ...product, [name]: value });
  };

  // Função para lidar com o envio do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    // Aqui você pode adicionar a lógica para salvar o produto, por exemplo, uma requisição para a API.
    console.log('Produto salvo:', product);

    // Exibir uma notificação de sucesso
    Swal.fire({
      title: 'Produto Adicionado!',
      text: 'O produto foi adicionado com sucesso.',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then(() => {
      // Redirecionar para a página de lista de produtos (ou qualquer página que você desejar)
      navigate('/estoque'); // Substitua '/estoque' pelo caminho correto onde a lista de produtos é exibida
    });

    // Resetar o formulário após o envio (opcional)
    setProduct({ nome: '', preco: '', quantidade: '' });
  };

  return (
    <div className="container">
      <header>
        <h1>Adicionar Produto</h1>
      </header>

      <div className="product-form">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome do Produto:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            value={product.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="preco">Preço:</label>
          <input
            type="number"
            id="preco"
            name="preco"
            value={product.preco}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="quantidade">Quantidade:</label>
          <input
            type="number"
            id="quantidade"
            name="quantidade"
            value={product.quantidade}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit">
            Salvar Produto
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
