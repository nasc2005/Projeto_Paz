import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/VendaController.php',
});

// Função para obter a lista de usuários
export async function getFunction() {
    const response = await api.get('/vendas');
    return response.data;
}

// Função para buscar uma venda específica pelo ID
export async function getVendaById(id) {
    const response = await api.get(`/venda/${id}`);
    return response.data;
}

// Função para criar um novo usuário
export async function postFunction(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;
}

// Função para deletar um usuário
export async function deleteFunction(id) {
    await api.delete(`/deletar/${id}`);
}

export default api;             