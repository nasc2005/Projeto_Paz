// src/pages/EditarProduto.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2';
import '../styles/editar-produto.css';

function EditarProduto() {
  // Estado inicial com valores preenchidos
  const [produto, setProduto] = useState({
    nome: 'Produto A',
    preco: 50,
    quantidade: 10,
  });

  // Função para lidar com as mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setProduto({ ...produto, [name]: value });
  };

  // Função para lidar com a submissão do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    // Aqui você pode adicionar a lógica para atualizar o produto no backend
    console.log('Produto atualizado:', produto);
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

  // Função para excluir o produto (pode ser uma chamada API ou outro comportamento)
  const handleDelete = () => {
    // Lógica para excluir o produto
    console.log('Produto excluído');
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

          <label htmlFor="preco">Preço:</label>
          <input
            type="number"
            id="preco"
            name="preco"
            value={produto.preco}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="quantidade">Quantidade:</label>
          <input
            type="number"
            id="quantidade"
            name="quantidade"
            value={produto.quantidade}
            onChange={handleInputChange}
            required
          />

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
