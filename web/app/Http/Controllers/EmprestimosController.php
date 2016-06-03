<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laracasts\Flash\FlashNotifier;
use App\Repositories\EmprestimoRepository;
use App\Repositories\TipoEmprestimoRepository;
use App\Repositories\ContatoRepository;
use App\Http\Requests\CreateEmprestimosRequest;
use Illuminate\Http\Request;
use Auth;

class EmprestimosController extends Controller
{
    protected $auth;
    protected $flash;
    protected $emprestimoRepository;
    protected $tipoEmprestimoRepository;
    protected $contatoRepository;

    public function __construct(FlashNotifier $flash,
                                EmprestimoRepository $emprestimoRepository,
                                TipoEmprestimoRepository $tipoEmprestimoRepository,
                                ContatoRepository $contatoRepository)
    {
        $this->auth = Auth::user();
        $this->flash = $flash;
        $this->emprestimoRepository = $emprestimoRepository;
        $this->tipoEmprestimoRepository = $tipoEmprestimoRepository;
        $this->contatoRepository = $contatoRepository;

        $this->middleware('auth');
    }

    public function getIndex()
    {
        $emprestimos = $this->emprestimoRepository->getAllByUsuario($this->auth->id);

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function getCreate()
    {
        $tiposEmprestimos = $this->tipoEmprestimoRepository->all();

        $contatos = $this->contatoRepository->all();

        return view('emprestimos.create', compact('tiposEmprestimos', 'contatos'));
    }

    public function postCreate(CreateEmprestimosRequest $request)
    {
        $data = $request->all();
        $data['usuario_id'] = $this->auth->id;

        $this->emprestimoRepository->create($data);

        $this->flash->success('Empréstimo cadastrado com sucesso!');

        return redirect('/emprestimos');
    }

    public function postBaixa(Request $request)
    {
        $emprestimo = $this->emprestimoRepository->find($request->input('id'));

        if(!$emprestimo) {
            $this->flash->error('Empréstimo não existe!');

            return redirect('/emprestimos');
        }

        $emprestimo->status = 'devolvido';

        if ($emprestimo->save()) {
            $this->flash->success('Empréstimo excluído com sucesso!');

            return redirect('/emprestimos');
        }

        $this->flash->error('Erro ao tentar excluir!');

        return redirect('/emprestimos');
    }
}
