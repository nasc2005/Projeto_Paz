import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/MetaController.php',
});

// Função para obter a lista de metas
export async function getFunction() {
    const response = await api.get('/metas');
    return response.data;

}

// Função para criar uma nova meta
export async function postFunction(data) {
    const response = await api.post('/metas', data);
    return response.data;

}

// Função para deletar uma meta
export async function deleteFunction(id) {
    await api.delete(`/metas/${id}`);

}

export default api;             