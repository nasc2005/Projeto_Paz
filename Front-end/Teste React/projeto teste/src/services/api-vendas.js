import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/VendaController.php',
});

// Função para obter a lista de vendas
export async function readVendas() {
    const response = await api.get('/vendas');
    return response.data;
}

// Função para buscar uma venda específica pelo ID
export async function readVendaById(id) {
    const response = await api.get(`/venda?id=${id}`);
    return response.data;
}

// Função para criar uma nova venda
export async function postVenda(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;
}

// Função para atualizar uma venda
export async function putVenda(idVenda, total, formaPagamento, statusVenda) {
    // Dados que você quer atualizar
    const data = {
        id_venda: idVenda, // O ID da venda que será atualizada
        total: total, // Novo total da venda
        forma_pagamento: formaPagamento, // Nova forma de pagamento
        status_venda: statusVenda // Novo status da venda
    };

    try {
        const response = await api.put(`/atualizar`, data); // Envia os dados para o endpoint de atualização
        return response.data; // Retorna a resposta da API
    } catch (error) {
        console.error('Erro ao atualizar a venda:', error);
        throw error; // Propaga o erro caso ocorra
    }
}

// Função para deletar uma venda
export async function deleteVenda(id) {
    await api.delete(`/deletar?id=${id}`);
}

export default api;             