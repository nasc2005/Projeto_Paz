import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/InstituicaoController.php',
});

// Função para obter a lista de instituições
export async function readInstituicao() {
    const response = await api.get('/instituicoes');
    return response.data;
}

// Função para criar uma nova instituição
export async function postInstituicao(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;
}

// Função para deletar uma instituição
export async function deleteInstituicao(id) {
    await api.delete(`/deletar/?id=${id}`);
}

export default api;             