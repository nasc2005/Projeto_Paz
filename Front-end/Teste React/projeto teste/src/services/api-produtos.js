import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/ProdutoController.php',
});

// Função para obter a lista de produtos
export async function readProdutos() {
    const response = await api.get('/produtos');
    return response.data;

}

// Função para buscar um produto específico pelo ID
export async function readProdutoById(id) {
    const response = await api.get(`/produto?id=${id}`);
    return response.data;
}

// Função para criar um novo produto
export async function postProduto(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;

}

// Função para atualizar um produto
export async function putProduto(data) {
    const response = await api.put('/atualizar', data);
    return response.data;
}

// Função para deletar um produto
export async function deleteProduto(id) {
    await api.delete(`/produto?id=${id}`);

}

export default api;             