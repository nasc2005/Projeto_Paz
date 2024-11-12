// src/pages/RecuperarSenha.jsx
import React, { useState } from 'react'; // Certifique-se de que o useState está sendo importado corretamente
import { Link } from 'react-router-dom';
import '../styles/recuperar-senha.css';
import { EnviaEmailRedefinindoSenha } from '../services/api-usuarios';

function RecuperarSenha() {
  const [email, setEmail] = useState('');
  const [error, setError] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(null);
  
    try {
      const response = await EnviaEmailRedefinindoSenha({ email });
      if (response.ok) {
        console.log("deu certo!!!");
      } else {
        setError('Email incorreto ou erro ao enviar.');
      }
    } catch (err) {
      setError('Erro ao tentar enviar o e-mail. Tente novamente mais tarde.');
      console.error(err);
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Projeto PAZ</h1>
      </header>

      <div className="reset-password-box">
        <h2>Recuperação de Senha</h2>
        <p>Insira seu e-mail para receber um link de redefinição de senha</p>
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
          <button type="submit">Enviar Link</button>
        </form>

        {error && <p className="error">{error}</p>} {/* Exibe a mensagem de erro */}

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
