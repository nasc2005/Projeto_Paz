// src/pages/RecuperarSenha.jsx
import React from 'react';
import { Link } from 'react-router-dom';
import '../styles/recuperar-senha.css';

function RecuperarSenha() {
  return (
    <div className="container">
      <header>
        <h1>Projeto PAZ</h1>
      </header>

      <div className="reset-password-box">
        <h2>Recuperação de Senha</h2>
        <p>Insira seu e-mail para receber um link de redefinição de senha</p>
        <form>
          <label htmlFor="email">E-mail</label>
          <input
            type="email"
            id="email"
            placeholder="Digite seu e-mail"
            required
          />

          <button type="submit">Enviar Link</button>
        </form>

        <div className="options">
          <Link to="/login">Voltar para o Login</Link>
        </div>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default RecuperarSenha;
