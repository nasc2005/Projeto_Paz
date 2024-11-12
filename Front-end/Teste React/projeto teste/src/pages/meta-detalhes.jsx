// src/pages/DetalhesMeta.jsx
import React, { useEffect, useState } from 'react';
import { Link, useNavigate, useParams } from 'react-router-dom';
import '../styles/meta-detalhes.css';
import Swal from 'sweetalert2'; // Importa o SweetAlert2
import { readMetaById } from '../services/api-metas';

function DetalhesMeta() {
  const { id } = useParams();
  
  const [meta, setMeta] = useState(null);

  // Função para buscar venda
  async function getMeta() {
      const response = await readMetaById(id);
      setMeta(response);
  }

  useEffect(() => {
    getMeta();
  }, [id]);

  const navigate = useNavigate();

  // Função para lidar com o encerramento da meta
  const handleEncerrarMeta = () => {
    Swal.fire({
      title: 'Tem certeza?',
      text: "Você quer realmente encerrar essa meta?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, encerrar meta!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Encerrada!',
          'A meta foi encerrada com sucesso.',
          'success'
        );
      }
    });
  };

  // Função para redirecionar para a página de criar meta
  const handleEditarMeta = () => {
    navigate(`/editar-meta/${meta.id_meta}`); // Redireciona para a página de cadastro de comunidade
  };

  return (
    <div className="container">
      <header>
        <h1>Detalhes da Meta</h1>
      </header>
      {meta ? (
        <div className="meta-details">
          <h2>{meta.nome || ''}</h2>
          <p><strong>Valor: R$ </strong> {meta.valor || ''}</p>
          <p><strong>Progresso Atual:</strong> trabalhando nisso</p>
          <p><strong>Data de Início:</strong> {new Intl.DateTimeFormat('pt-BR', { dateStyle: 'short', timeStyle: 'short' }).format(new Date(meta.data_criacao))}</p>
          <p><strong>Data de Término:</strong> trabalhando nisso</p>
          <p><strong>Status:</strong> {meta.status_meta || ''}</p>

          <div className="actions">
            <Link to="/editar-meta" className="btn-edit" onClick={handleEditarMeta}>Editar Meta</Link>
            <button className="btn-close" onClick={handleEncerrarMeta}>Encerrar Meta</button>
          </div>
        </div>
      ) : (
        <p>Carregando detalhes da venda...</p>
      )}

      

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default DetalhesMeta;