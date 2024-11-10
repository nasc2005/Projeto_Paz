import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import '../styles/venda-concluida.css';
import { readVendaById } from '../services/api-vendas';

function VendaConcluida() {
  const { id } = useParams();

  const [venda, setVenda] = useState(null); // Para detalhes gerais da venda
  const [produtos, setProdutos] = useState([]); // Para lista de produtos vendidos

  // Função para buscar venda
  async function getVenda() {
    try {
      const response = await readVendaById(id);

      // Checa se a resposta não está vazia
      if (response && response.length > 0) {
        // Separa os detalhes gerais da venda (usando o primeiro item)
        const detalhesVenda = {
          id_venda: response[0].id_venda,
          data_criacao: response[0].data_criacao,
          forma_pagamento: response[0].forma_pagamento,
          status_venda: response[0].status_venda,
        };

        // Extrai a lista de produtos vendidos
        const listaProdutos = response.map(item => ({
          id_produto: item.id_produto,
          nome: item.nome,
          quantidade: item.quantidade,
          valor_item: item.valor_item,
          valor_venda: item.valor_venda,
        }));

        setVenda(detalhesVenda);
        setProdutos(listaProdutos);
      }
    } catch (error) {
      console.error("Erro ao buscar detalhes da venda:", error);
    }
  }

  useEffect(() => {
    getVenda();
  }, [id]);

  return (
    <div className="container">
      <header>
        <h1>Venda #{id}</h1>
      </header>

      {venda ? (
        <div className="sale-details">
          <h2>Detalhes da Venda</h2>
          <ul>
            <li><strong>Data:</strong> {new Intl.DateTimeFormat('pt-BR', { dateStyle: 'short', timeStyle: 'short' }).format(new Date(venda.data_criacao))}</li>
            <li><strong>Forma de Pagamento:</strong> {venda.forma_pagamento}</li>
            <li><strong>Status:</strong> {venda.status_venda}</li>
          </ul>
        </div>
      ) : (
        <p>Carregando detalhes da venda...</p>
      )}

      <div className="product-list">
        <h2>Produtos Vendidos</h2>
        {produtos.length > 0 ? (
          <ul>
            {produtos.map((produto) => (
              <li key={produto.id_produto}>
                {produto.nome} - Quantidade: {produto.quantidade} - Total: R$ {(produto.valor_item).toFixed(2)}
              </li>
            ))}
          </ul>
        ) : (
          <p>Carregando produtos...</p>
        )}
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default VendaConcluida;