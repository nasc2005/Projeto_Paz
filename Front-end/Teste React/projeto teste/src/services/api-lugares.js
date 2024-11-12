import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/LugarController.php',
});

// Função para obter a lista de lugares
export async function readLugares() {
    const response = await api.get('/lugares');
    return response.data;

}

// Função para buscar um lugar específico pelo ID
export async function readLugarById(id) {
    const response = await api.get(`/lugar?id=${id}`);
    return response.data;
}

// Função para criar um novo lugar
export async function postLugar(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;
}

// Função para criar um novo lugar
export async function putLugar(data) {
    const response = await api.put(`/atualizar`, data);
    return response.data;
}

// Função para deletar um lugar
export async function deleteLugar(id) {
    await api.delete(`/deletar/?id=${id}`);
    
}

export default api;             