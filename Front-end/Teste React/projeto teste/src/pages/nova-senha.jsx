// src/pages/NovaSenha.jsx
import React from 'react';
import { Link } from 'react-router-dom';
import '../styles/nova-senha.css';

function NovaSenha() {
  return (
    <div className="container">
      <header>
        <h1>Projeto PAZ</h1>
      </header>

      <div className="reset-password-box">
        <h2>Criar Nova Senha</h2>
        <p>Digite sua nova senha para atualizar sua conta</p>
        <form>
          <label htmlFor="new-password">Nova Senha</label>
          <input
            type="password"
            id="new-password"
            placeholder="Digite sua nova senha"
            required
          />

          <label htmlFor="confirm-password">Confirmar Nova Senha</label>
          <input
            type="password"
            id="confirm-password"
            placeholder="Confirme sua nova senha"
            required
          />

          <button type="submit">Redefinir Senha</button>
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

export default NovaSenha;
