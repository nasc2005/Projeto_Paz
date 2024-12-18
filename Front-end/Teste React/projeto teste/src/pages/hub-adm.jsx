import React, { useEffect, useState } from 'react';
import { Link, useNavigate  } from 'react-router-dom'; // Importar Link do React Router
import '../styles/hub-adm.css';  // Certifique-se de ter o arquivo CSS correspondente

// Importe as imagens dinamicamente da pasta src/assets
import editarContaImg from '../assets/editar-conta.png';
import abrirVendasImg from '../assets/abrir-vendas.png';
import visualizarLugaresImg from '../assets/visualizar-lugares.png';
import cadastrarVendedorImg from '../assets/cadastrar-vendedor.png';
import cadastroAdmImg from '../assets/cadastro-adm.png';
import visualizarVendasImg from '../assets/visualizar-vendas.png';
import visualizarEstoqueImg from '../assets/visualizar-estoque.png';
import visualizarRelatorioImg from '../assets/visualizar-relatorio.png';
import visualizarEstatisticasImg from '../assets/visualizar-estatisticas.png';
import visualizarMetasImg from '../assets/visualizar-metas.png';

function HubAdm() {

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
      link: userId ? `/editar-conta/${userId}` : '/login',
    },
    {
      title: 'Abrir Vendas',
      description: 'Comece uma nova venda para seus clientes.',
      imgSrc: abrirVendasImg,
      link: '/abrir-vendas',
    },
    {
      title: 'Visualizar Lugares',
      description: 'Gerencie os lugares disponíveis na sua instituição.',
      imgSrc: visualizarLugaresImg,
      link: '/visualizar-lugares',
    },
    {
      title: 'Cadastrar Vendedor',
      description: 'Cadastre novos vendedores para sua equipe.',
      imgSrc: cadastrarVendedorImg,
      link: '/cadastrar-vendedor',
    },
    {
      title: 'Cadastrar ADM',
      description: 'Adicione novos administradores ao sistema.',
      imgSrc: cadastroAdmImg,
      link: '/cadastro-adm',
    },
    {
      title: 'Vendas Concluídas',
      description: 'Veja todas as vendas que foram finalizadas.',
      imgSrc: visualizarVendasImg,
      link: '/visualizar-vendas-concluidas',
    },
    {
      title: 'Visualizar Estoque',
      description: 'Verifique os produtos disponíveis e suas quantidades.',
      imgSrc: visualizarEstoqueImg,
      link: '/visualizar-estoque',
    },
     {
       title: 'Visualizar Metas',
       description: 'Monitore suas metas e o progresso de vendas.',
       imgSrc: visualizarMetasImg,
       link: '/visualizar-metas',
    },
  ];

  return (
    <div className="container">
      <header>
        <h1>Hub ADM</h1>
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

export default HubAdm;