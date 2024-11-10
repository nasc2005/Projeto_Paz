import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/ProdutoController.php',
});

// Função para obter a lista de produtos
export async function getFunction() {
    const response = await api.get('/produtos');
    return response.data;

}

// Função para buscar um produto específico pelo ID
export async function getProdutoById(id) {
    const response = await api.get(`/produtos/${id}`);
    return response.data;
}

// Função para criar um novo produto
export async function postFunction(data) {
    const response = await api.post('/produtos', data);
    return response.data;

}

// Função para deletar um produto
export async function deleteFunction(id) {
    await api.delete(`/produtos/${id}`);

}

export default api;             