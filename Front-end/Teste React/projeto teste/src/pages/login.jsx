// src/pages/Login.jsx
import React from 'react';
import { Link } from 'react-router-dom';
import '../styles/login.css';

function Login() {
  return (
    <div className="container">
      <header>
        <h1>Projeto PAZ</h1>
      </header>

      <div className="login-box">
        <h2>Entrar no Sistema</h2>
        <form>
          <label htmlFor="email">E-mail</label>
          <input type="email" id="email" placeholder="Digite seu e-mail" required />

          <label htmlFor="password">Senha</label>
          <input type="password" id="password" placeholder="Digite sua senha" required />

          <button type="submit">Entrar</button>
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
