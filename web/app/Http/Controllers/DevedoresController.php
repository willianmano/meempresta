<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laracasts\Flash\FlashNotifier;
use App\Repositories\EmprestimoRepository;
use Auth;

class DevedoresController extends Controller
{
    protected $auth;
    protected $flash;
    protected $emprestimoRepository;
    protected $tipoEmprestimoRepository;
    protected $contatoRepository;

    public function __construct(FlashNotifier $flash,
                                EmprestimoRepository $emprestimoRepository)
    {
        $this->auth = Auth::user();
        $this->flash = $flash;
        $this->emprestimoRepository = $emprestimoRepository;

        $this->middleware('auth');
    }

    public function getIndex()
    {
        $devedores = $this->emprestimoRepository->getDevedores();

        return view('devedores.index', compact('devedores'));
    }
}
