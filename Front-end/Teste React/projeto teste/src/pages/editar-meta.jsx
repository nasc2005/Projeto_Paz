import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom'; // Importando o hook para navegação
import '../styles/editar-meta.css';

function EditarMeta() {
  // Estado inicial com valores preenchidos
  const [meta, setMeta] = useState({
    nome: 'Meta de Vendas - Janeiro',
    descricao: 'Aumentar as vendas em 20% durante o mês de Janeiro.',
    prazo: '2024-01-31',
  });

  // Inicializando o hook useNavigate para redirecionamento
  const navigate = useNavigate();

  // Função para lidar com as mudanças nos campos de entrada
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setMeta({ ...meta, [name]: value });
  };

  // Função para lidar com a submissão do formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    // Aqui você pode adicionar a lógica para salvar as alterações da meta
    console.log('Alterações salvas:', meta);
    // Redirecionar para a página de listagem de metas (ou qualquer outra página)
    navigate('/metas'); // Substitua '/metas' pela rota de destino desejada
  };

  // Função para encerrar a meta (pode ser customizada conforme necessário)
  const handleEncerrarMeta = () => {
    // Lógica para encerrar a meta (pode ser uma chamada API ou outro comportamento)
    console.log('Meta encerrada');
    // Redirecionar para a página de listagem de metas após encerrar
    navigate('/metas'); // Substitua '/metas' pela rota desejada
  };

  return (
    <div className="container">
      <header>
        <h1>Editar Meta</h1>
      </header>

      <div className="form-section">
        <form onSubmit={handleSubmit}>
          <label htmlFor="nome">Nome da Meta:</label>
          <input
            type="text"
            id="nome"
            name="nome"
            value={meta.nome}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="descricao">Descrição:</label>
          <textarea
            id="descricao"
            name="descricao"
            value={meta.descricao}
            onChange={handleInputChange}
            required
          />

          <label htmlFor="prazo">Prazo:</label>
          <input
            type="date"
            id="prazo"
            name="prazo"
            value={meta.prazo}
            onChange={handleInputChange}
            required
          />

          <button type="submit" className="btn-submit">
            Salvar Alterações
          </button>
          <button
            type="button"
            className="btn-close"
            onClick={handleEncerrarMeta}
          >
            Encerrar Meta
          </button>
        </form>
      </div>

      <footer>
        <p>&copy; 2024 Projeto PAZ. Todos os direitos reservados.</p>
      </footer>
    </div>
  );
}

export default EditarMeta;
