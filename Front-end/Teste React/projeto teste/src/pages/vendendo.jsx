import { React, useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import '../styles/vendendo.css';
import { readProdutos } from '../services/api-produtos';
import { readVendas } from '../services/api-vendas';
import { readVendaById } from '../services/api-vendas';
import { postVenda } from '../services/api-vendas';
import { postItensVenda } from '../services/api-itensVendas';

function Vendendo() {
  const [carrinho, setCarrinho] = useState([]);
  const [produtos, setProdutos] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    async function getProdutos() {
      const response = await readProdutos();
      setProdutos(response);

      const produtosSelecionados = JSON.parse(localStorage.getItem('selectedProducts')) || [];
      const carrinhoInicial = produtosSelecionados.map(produto => ({
        ...produto,
        quantidade: 1,
        subtotal: parseFloat(produto.valor_venda),
      }));
      setCarrinho(carrinhoInicial);
    }
    getProdutos();
  }, []);

  const finalizarVenda = async () => {
    try {
      const vendaData = {
        id_usuario: localStorage.getItem('userId'),
        id_lugar: localStorage.getItem('selectedLocationId'),
        id_imgsVenda: 1,
        total: carrinho.reduce((total, item) => total + item.subtotal, 0),
        status_venda: 'Em andamento',
        forma_pagamento: null,
      };

      const vendaResponse = await postVenda(vendaData);
      const idVendaCriada = vendaResponse?.id_venda;
      if (!idVendaCriada) {
        console.log(idVendaCriada)
        throw new Error('Erro ao criar venda: ID da venda não retornado');
      }

      const itensVendaData = carrinho.map((produto) => ({
        id_produto: produto.id_produto,
        id_venda: idVendaCriada,
        quantidade: produto.quantidade,
        preco_unitario: produto.valor_venda,
        subtotal: produto.subtotal,
      }));

      await Promise.all(itensVendaData.map(item => postItensVenda(item)));

      localStorage.setItem('idVenda', idVendaCriada);
      setCarrinho([]);
      localStorage.removeItem('selectedProducts');
      navigate(`/finalizar-venda/${idVendaCriada}`);
    } catch (error) {
      console.error('Erro ao finalizar a venda:', error);
      navigate('/finalizar-venda');
      //alert('Ocorreu um erro ao finalizar a venda.');
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Vendendo</h1>
      </header>

      <div className="sales-list">
        <h2>Carrinho de Compras</h2>
        <ul>
          {carrinho.map((produto) => (
            <li key={produto.id_produto}>
              {produto.nome} - R$ {produto.valor_venda.toFixed(2)} x {produto.quantidade} = R$ {produto.subtotal.toFixed(2)}
            </li>
          ))}
        </ul>
        <h3>Total: R$ {carrinho.reduce((total, item) => total + item.subtotal, 0).toFixed(2)}</h3>
        
        <button onClick={finalizarVenda} className="btn-finalize-sale">
          Finalizar Venda
        </button>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default Vendendo;