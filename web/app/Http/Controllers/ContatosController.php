<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContatosRequest;
use App\Http\Controllers\Controller;
use App\Repositories\ContatoRepository;
use Laracasts\Flash\FlashNotifier;
use Illuminate\Http\Request;
use App\Models\Contato;
use Auth;

class ContatosController extends Controller
{

    protected $flash;
    protected $auth;
    protected $contatoRepository;

    public function __construct(FlashNotifier $flash, ContatoRepository $contatoRepository)
    {
        $this->flash = $flash;
        $this->auth = Auth::user();
        $this->contatoRepository = $contatoRepository;

        $this->middleware('auth');
    }

    public function getIndex()
    {
        $contatos = $this->contatoRepository->all();

        return view('contatos.index', compact('contatos'));
    }

    public function getCreate()
    {
        return view('contatos.create');
    }

    public function postCreate(CreateContatosRequest $request)
    {
        $this->contatoRepository->create($request->all());

        $this->flash->success('Contato cadastrado com sucesso!');

        return redirect('/contatos');
    }

    public function getEdit($id)
    {
        $contato = $this->contatoRepository->find($id);

        return view('contatos.edit', compact('contato'));
    }

    public function postEdit(Request $request)
    {
        $contato = $this->contatoRepository->find($request->input('id'));

        $contato->fill($request->all());

        $contato->save();

        $this->flash->success('Contato atualizado com sucesso!');

        return redirect('/contatos');
    }

    public function postDelete(Request $request, Contato $contato)
    {
        $contato = $contato->find($request->input('id'));

        if ($contato->delete()) {
            $this->flash->success('Contato excluído com sucesso!');

            return redirect('/contatos');
        }

        $this->flash->error('Erro ao tentar excluir!');

        return redirect('/contatos');
    }
}
