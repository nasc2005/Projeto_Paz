import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/ItensVendaController.php',
});

// Função para obter a lista de vendas
export async function readItensVendas() {
    const response = await api.get('/itens-vendas');
    return response.data;
}

// Função para buscar uma venda específica pelo ID
export async function readItemVendaById(id) {
    const response = await api.get(`/item-venda?id=${id}`);
    return response.data;
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