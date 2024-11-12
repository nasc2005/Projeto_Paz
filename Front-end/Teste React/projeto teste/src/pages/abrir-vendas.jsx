import { React, useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Swal from 'sweetalert2';
import '../styles/abrir-vendas.css';
import { readLugares } from '../services/api-lugares';
import { readProdutos } from '../services/api-produtos';

function AbrirVendas() {
  const [products, setProducts] = useState([]);
  const [selectedProducts, setSelectedProducts] = useState([{ id: 1, value: '' }]); // Para produtos selecionados
  const [lugares, setLugares] = useState([]);

  async function getProdutos() {
    const response = await readProdutos();
    setProducts(response); // Define a lista de produtos disponíveis
  }

  useEffect(() => {
    getProdutos();
  }, []);

  async function getLugares() {
    const response = await readLugares();
    setLugares(response); // Define a lista de lugares disponíveis
  }

  useEffect(() => {
    getLugares();
  }, []);

  const navigate = useNavigate();

  // Função para adicionar um novo campo de produto
  const addProductField = () => {
    setSelectedProducts([...selectedProducts, { id: selectedProducts.length + 1, value: '' }]);
  };

  // Função para atualizar o valor de um produto selecionado
  const handleProductChange = (index, event) => {
    const updatedProducts = [...selectedProducts];
    updatedProducts[index].value = event.target.value;
    setSelectedProducts(updatedProducts);
  };

  // Função para remover um campo de produto
  const removeProductField = (index) => {
    const updatedProducts = selectedProducts.filter((_, i) => i !== index);
    setSelectedProducts(updatedProducts);
  };

  // Função para notificar falta de produto
  const notifyProductShortage = () => {
    const navigate = useNavigate(); // useNavigate hook
    
    Swal.fire({
      title: 'Deseja Adicionar uma nova comunidade!',
      text: 'Aonde Você está, crie uma agora.',
      icon: 'warning',
      confirmButtonText: 'OK',
    }).then((result) => {
      if (result.isConfirmed) {
        // Navegar para outra tela após clicar no "OK"
        navigate('/visualizar-lugares'); // Substitua com a rota que deseja ir
      }
    });
  };
  

  const handleSubmit = (e) => {
    e.preventDefault();

    // Extrai o ID do lugar selecionado
    const selectedLocationId = document.getElementById('location').value;

    // Armazena o ID do lugar no localStorage
    localStorage.setItem('selectedLocationId', selectedLocationId);
  
    // Extrai os produtos selecionados e formata-os para armazenar no localStorage
    const productsToSave = selectedProducts.map((selectedProduct) => {
      const product = products.find((p) => p.id_produto === Number(selectedProduct.value));
      return {
        id_produto: product?.id_produto,
        nome: product?.nome,
        valor_venda: product?.valor_venda,
      };
    });
  
    // Armazena os produtos selecionados no localStorage
    localStorage.setItem('selectedProducts', JSON.stringify(productsToSave));
  
    // Navega para a página "vendendo" após o envio do formulário
    navigate('/vendendo');
  };

  return (
    <div className="container">
      <header>
        <h1>Abrir Vendas</h1>
      </header>

      <form onSubmit={handleSubmit} className="sales-form">
        <div className="form-group">
          <label htmlFor="location">Local de Venda:</label>
          <select id="location" name="location" required>
            <option value="">Selecione um lugar</option>
            {lugares.map((lugar) => (
              <option key={lugar.id_lugar} value={lugar.id_lugar}>
                {lugar.apelido}
              </option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label htmlFor="seller">Vendedor:</label>
          <input type="text" id="seller" name="seller" placeholder="Digite o nome do vendedor" required />
        </div>

        <div className="form-group">
          <label htmlFor="products">Produtos:</label>
          <div id="product-list">
          {selectedProducts.map((selectedProduct, index) => (
            <div className="product-item" key={selectedProduct.value}>
              <select
                name="products[]"
                value={selectedProduct.value}
                onChange={(e) => handleProductChange(index, e)}
                required
              >
                <option value="">Selecione um produto</option>
                {products.map((product) => (
                  <option key={product.id_produto} value={product.id_produto}>
                    {product.nome} - R$ {product.valor_venda.toFixed(2)}
                  </option>
                ))}
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

        {/* <button type="button" className="btn-open-sales" onClick={notifyProductShortage}>
          Adiconar Nova Comunidade
        </button> */}

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