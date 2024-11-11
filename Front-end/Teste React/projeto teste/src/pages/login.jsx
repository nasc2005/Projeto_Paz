import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import '../styles/login.css';
import { postLogin } from '../services/api-usuarios';

function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState(null);
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(null); // Limpar erro anterior

    try {
      const response = await postLogin({ email, senha: password });
      if (response.usuario) {
        // Login bem-sucedido, redirecionar para a página desejada
        if ((response.usuario.perfil) == 'Administrador') {
          localStorage.setItem('userId', response.usuario.id_usuario);
          localStorage.setItem('instId', response.usuario.id_instituicao);
          navigate('/hub-adm');
        }
        if ((response.usuario.perfil) == 'Vendedor') {
          localStorage.setItem('userId', response.usuario.id_usuario);
          localStorage.setItem('instId', response.usuario.id_instituicao);
          navigate('/hub-vendedor');
        }
      } else {
        setError('Email ou senha incorretos.');
      }
    } catch (err) {
      setError('Erro ao tentar fazer login. Tente novamente mais tarde.');
      console.error(err);
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Projeto PAZ</h1>
      </header>

      <div className="login-box">
        <h2>Entrar no Sistema</h2>
        <form onSubmit={handleSubmit}>
          <label htmlFor="email">E-mail</label>
          <input
            type="email"
            id="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="Digite seu e-mail"
            required
          />

          <label htmlFor="password">Senha</label>
          <input
            type="password"
            id="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            placeholder="Digite sua senha"
            required
          />

          <button type="submit">Entrar</button>

          {error && <p className="error-message">{error}</p>}
        </form>

        <div className="options">
          <Link to="/cadastroInstituicao">Cadastrar-se</Link>
          <Link to="/recuperar-senha">Esqueceu sua senha?</Link>
        </div>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default Login;