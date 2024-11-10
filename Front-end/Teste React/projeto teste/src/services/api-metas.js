import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/MetaController.php',
});

// Função para obter a lista de metas
export async function readMetas() {
    const response = await api.get('/metas');
    return response.data;

}

// Função para buscar um lugar específico pelo ID
export async function readMetaById(id) {
    const response = await api.get(`/meta?id=${id}`);
    return response.data;
}

// Função para criar uma nova meta
export async function postMeta(data) {
    const response = await api.post('/criar', data);
    return response.data;

}

// Função para criar uma nova meta
export async function putMeta(data) {
    const response = await api.put(`/atualizar`, data);
    return response.data;
}

// Função para deletar uma meta
export async function deleteMeta(id) {
    await api.delete(`/meta?id=${id}`);

}

export default api;