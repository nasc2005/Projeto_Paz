import React, { useEffect, useState } from 'react';
import { Link, useNavigate  } from 'react-router-dom'; // Importar Link do React Router
import '../styles/hub-vendedor.css';  // Importe o arquivo CSS correspondente

// Importe as imagens dinamicamente da pasta src/assets
import editarContaImg from '../assets/editar-conta.png';
import abrirVendasImg from '../assets/abrir-vendas.png';
import visualizarEstoqueImg from '../assets/visualizar-estoque.png';
import visualizarMetasImg from '../assets/visualizar-metas.png';

function HubVendedor() {

  const [userId, setUserId] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const id = localStorage.getItem('userId');
    if (id) {
      setUserId(id);
    } else {
      // Se o usuário não estiver logado, redirecione para a página de login
      navigate('/login');
    }
  }, [navigate]);

  const handleLogout = () => {
    localStorage.removeItem('userId'); // Remove o ID do usuário do local storage
    localStorage.removeItem('instId');
    navigate('/login'); // Redireciona para a página de login
  };

  const actions = [
    {
      title: 'Editar Conta',
      description: 'Atualize as informações da sua conta rapidamente.',
      imgSrc: editarContaImg,  // Caminho das imagens importadas
      link: userId ? `/editar-conta/${userId}` : '/login',  // Usando a rota do React Router
    },
    {
      title: 'Abrir Vendas',
      description: 'Comece uma nova venda para seus clientes.',
      imgSrc: abrirVendasImg,
      link: '/abrir-vendas',
    },
    {
      title: 'Visualizar Estoque',
      description: 'Veja os produtos disponíveis e suas quantidades.',
      imgSrc: visualizarEstoqueImg,
      link: '/visualizar-estoque',
    },
    // {
    //   title: 'Visualizar Metas',
    //   description: 'Confira suas metas e o progresso de vendas.',
    //   imgSrc: visualizarMetasImg,
    //   link: '/visualizar-metas',
    // },
  ];

  return (
    <div className="container">
      <header>
        <h1>Hub Vendedor</h1>
        <button onClick={handleLogout} className="logout-button">
          Logoff
        </button>
      </header>

      <div className="actions-grid">
        {actions.map((action, index) => (
          <div key={index} className="card">
            <img src={action.imgSrc} alt={action.title} />
            <div className="card-content">
              <h2>{action.title}</h2>
              <p>{action.description}</p>
              {/* Substituindo <a> por <Link> para navegação React Router */}
              <Link to={action.link} className="action-link">
                Acessar
              </Link>
            </div>
          </div>
        ))}
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default HubVendedor;
