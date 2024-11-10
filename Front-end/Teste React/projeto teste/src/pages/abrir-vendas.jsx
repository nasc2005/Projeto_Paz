// src/pages/AbrirVendas.jsx
import React, { useState } from 'react';
import Swal from 'sweetalert2';
import { useNavigate } from 'react-router-dom';  // Importando o hook useNavigate para navegação
import '../styles/abrir-vendas.css';

function AbrirVendas() {
  const [products, setProducts] = useState([{ id: 1, value: '' }]);
  const navigate = useNavigate();  // Hook para navegação

  // Função para adicionar um novo campo de produto
  const addProductField = () => {
    setProducts([...products, { id: products.length + 1, value: '' }]);
  };

  // Função para atualizar o valor de um produto selecionado
  const handleProductChange = (index, event) => {
    const updatedProducts = [...products];
    updatedProducts[index].value = event.target.value;
    setProducts(updatedProducts);
  };

  // Função para remover um campo de produto
  const removeProductField = (index) => {
    const updatedProducts = products.filter((_, i) => i !== index);
    setProducts(updatedProducts);
  };

  // Função para notificar falta de produto
  const notifyProductShortage = () => {
    Swal.fire({
      title: 'Falta de Produto!',
      text: 'Notificação de falta de produto enviada com sucesso.',
      icon: 'warning',
      confirmButtonText: 'OK',
    });
  };

  // Função para enviar o formulário e redirecionar para "vendendo"
  const handleSubmit = (e) => {
    e.preventDefault();
    // Lógica adicional para enviar a venda (se necessário)

    // Navegar para a página "vendendo" após o envio do formulário
    navigate('/vendendo');  // Redireciona para a página 'vendendo'
  };

  return (
    <div className="container">
      <header>
        <h1>Abrir Vendas</h1>
      </header>

      <form onSubmit={handleSubmit} className="sales-form">
        <div className="form-group">
          <label htmlFor="date">Data da Venda:</label>
          <input type="date" id="date" name="date" required />
        </div>

        <div className="form-group">
          <label htmlFor="location">Local de Venda:</label>
          <input type="text" id="location" name="location" placeholder="Digite o local de venda" required />
        </div>

        <div className="form-group">
          <label htmlFor="seller">Vendedor:</label>
          <input type="text" id="seller" name="seller" placeholder="Digite o nome do vendedor" required />
        </div>

        <div className="form-group">
          <label htmlFor="products">Produtos:</label>
          <div id="product-list">
            {products.map((product, index) => (
              <div className="product-item" key={product.id}>
                <select
                  name="products[]"
                  value={product.value}
                  onChange={(e) => handleProductChange(index, e)}
                  required
                >
                  <option value="">Selecione um produto</option>
                  <option value="produto1">Produto 1</option>
                  <option value="produto2">Produto 2</option>
                  <option value="produto3">Produto 3</option>
                  <option value="produto4">Produto 4</option>
                </select>
                <button
                  type="button"
                  className="remove-btn"
                  onClick={() => removeProductField(index)}
                >
                  X
                </button>
              </div>
            ))}
          </div>
          <button type="button" className="btn-open-sales" onClick={addProductField}>
            Adicionar Mais Produtos
          </button>
        </div>

        <button type="button" className="btn-open-sales" onClick={notifyProductShortage}>
          Notificar Falta de Produto
        </button>

        <button type="submit" className="btn-open-sales">
          Iniciar Venda
        </button>
      </form>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default AbrirVendas;
