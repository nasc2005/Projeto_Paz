import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/ItensVendaController.php',
});

// Função para obter a lista de vendas
export async function readItensVenda() {
    const response = await api.get('/itens-vendas');
    return response.data;
}

export async function readItensVendaByIdVenda(id) {
    try {
        const response = await api.get(`/item-venda?id=${id}`);
        return response.data;  // Espera-se que `response.data` seja um array de itens
    } catch (error) {
        console.error('Erro ao buscar itens da venda:', error);
        return [];  // Retorna um array vazio em caso de erro
    }
}

// Função para criar uma nova venda
export async function postItensVenda(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;
}

// Função para atualizar uma venda
export async function putItensVenda(data) {
    const response = await api.put(`/atualizar`, data);
    return response.data;
}

// Função para deletar uma venda
export async function deleteItensVenda(id) {
    await api.delete(`/deletar?id=${id}`);
}

export default api;             