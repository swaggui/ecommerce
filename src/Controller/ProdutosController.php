<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Produtos Controller
 *
 * @property \App\Model\Table\ProdutosTable $Produtos
 * @method \App\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
    }

    /**
     * View method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('produto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $produto = $this->Produtos->newEmptyEntity();
        if ($this->request->is('post')) {
            // Gerenciar o upload da imagem
            $imagem = $this->request->getData('imagem');
            if ($imagem && $imagem->getError() === UPLOAD_ERR_OK) {
                $nomeArquivo = time() . '-' . $imagem->getClientFilename(); // Nome único para a imagem
                $imagem->moveTo(WWW_ROOT . 'img/produtos/' . $nomeArquivo); // Salvando a imagem na pasta 'img/produtos'
                $produto->imagem = $nomeArquivo; // Armazenando o nome da imagem no banco
            }

            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('O produto foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível salvar o produto. Tente novamente.'));
        }
        $this->set(compact('produto'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $produto = $this->Produtos->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Gerenciar o upload da imagem
            $imagem = $this->request->getData('imagem');
            if ($imagem && $imagem->getError() === UPLOAD_ERR_OK) {
                $nomeArquivo = time() . '-' . $imagem->getClientFilename();
                $imagem->moveTo(WWW_ROOT . 'img/produtos/' . $nomeArquivo);
                $produto->imagem = $nomeArquivo;
            }

            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('O produto foi atualizado com sucesso.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível atualizar o produto. Tente novamente.'));
        }
        $this->set(compact('produto'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($id);
        if ($this->Produtos->delete($produto)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
