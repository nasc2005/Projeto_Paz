import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/UsuarioController.php',
});
const api2 = axios.create({
    baseURL: 'http://localhost:8000/BackendProjetoPaz/Controller/EmailsController.php',
});
// Função para obter a lista de usuários
export async function readUsuarios() {
    const response = await api.get('/usuarios');
    return response.data;
}

// Função para buscar um usuário específico pelo ID
export async function readUserById(id) {
    const response = await api.get(`/usuario?id=${id}`);
    return response.data;
}

// Função para obter a lista de usuários por perfil
export async function readPerfilUsuarios() {
    const response = await api.get('action=perfil');
    return response.data;
}

// Função para obter a lista de usuários por perfil
export async function EnviaEmailRedefinindoSenha(email) {
    console.log("chegooooooooooo");
    console.log(email);
    const response = await api2.get(`?action=Redefinir&email=murilovnasc.prog@gmail.com`);
    return response.data;
}

// Função para criar um novo usuário
export async function postUsuario(data) {
    const response = await api.post('/cadastrar', data);
    return response.data;
}

// Função para conferir login
export async function postLogin(data) {
    const response = await api.post('?action=login', data);
    return response.data;
}

// Função para atualizar um usuário
export async function putUsuario(data) {
    const response = await api.put('/atualizar', data);
    return response.data;
}

// Função para deletar um usuário
export async function deleteUsuario(id) {
    await api.delete(`/deletar?id=${id}`);
}

export default api;             