// src/pages/NovaSenha.jsx
import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import Swal from 'sweetalert2';
import '../styles/nova-senha.css';

function NovaSenha() {
  const [newPassword, setNewPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (newPassword === confirmPassword) {
      Swal.fire({
        icon: 'success',
        title: 'Senha redefinida com sucesso!',
        text: 'Agora você pode acessar sua conta com a nova senha.',
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Erro',
        text: 'As senhas não coincidem. Tente novamente.',
      });
    }
  };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  return (
    <div className="container">
      <header>
        <h1>Projeto PAZ</h1>
      </header>

      <div className="reset-password-box">
        <h2>Criar Nova Senha</h2>
        <p>Digite sua nova senha para atualizar sua conta</p>
        <form onSubmit={handleSubmit}>
          <label htmlFor="new-password">Nova Senha</label>
          <div className="password-input-container">
            <input
              type={showPassword ? 'text' : 'password'}
              id="new-password"
              placeholder="Digite sua nova senha"
              value={newPassword}
              onChange={(e) => setNewPassword(e.target.value)}
              required
            />
            <span className="toggle-password" onClick={togglePasswordVisibility}>
              {showPassword ? '👁️' : '🙈'}
            </span>
          </div>

          <label htmlFor="confirm-password">Confirmar Nova Senha</label>
          <div className="password-input-container">
            <input
              type={showPassword ? 'text' : 'password'}
              id="confirm-password"
              placeholder="Confirme sua nova senha"
              value={confirmPassword}
              onChange={(e) => setConfirmPassword(e.target.value)}
              required
            />
            <span className="toggle-password" onClick={togglePasswordVisibility}>
              {showPassword ? '👁️' : '🙈'}
            </span>
          </div>

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
