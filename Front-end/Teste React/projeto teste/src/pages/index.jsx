// src/pages/Index.jsx
import React from 'react';
import { Link } from 'react-router-dom';
import '../styles/home.css';
import logo from '../assets/logo.png';

function Index() {
  return (
    <div className="container">
      <header>
        <img src={logo} alt="Logo Projeto PAZ" className="logo" />
      </header>

      <div className="content">
      <section class="purpose">
                <h1>Bem-vindo ao Projeto PAZ</h1>
                <p>Nossa missão é transformar vidas através de ações e vendas solidárias, levando recursos para instituições religiosas e comunidades carentes.</p>
            </section>

            <section class="history">
                <h2>Nossa História</h2>
                <p>Fundado em 2024, o Projeto PAZ surgiu da necessidade de fortalecer a relação entre igrejas e comunidades. Desde então, temos ajudado inúmeras instituições a alcançar suas metas e expandir seu impacto.</p>
            </section>

            <section class="description">
                <h2>O que fazemos</h2>
                <p>Facilitamos a organização de vendas e doações dentro das instituições, proporcionando um ambiente digital para gerenciamento de recursos e campanhas solidárias.</p>
            </section>

        <div className="cta-buttons">
          <Link to="/login" className="btn">Entrar no Sistema</Link>
        </div>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default Index;
