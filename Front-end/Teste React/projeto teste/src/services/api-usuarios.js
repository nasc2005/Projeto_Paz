import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/UsuarioController.php',
});

// Função para obter a lista de usuários
export async function getFunction() {
    const response = await api.get('/usuarios');
    return response.data;

}

// Função para buscar um usuário específico pelo ID
export async function getUserById(id) {
    const response = await api.get(`/usuario/${id}`);
    return response.data;
}

// Função para obter a lista de usuários por perfil
export async function getPerfilUsuarios() {
    const response = await api.get('action=perfil');
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