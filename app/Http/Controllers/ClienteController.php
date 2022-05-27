<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $clientes = Cliente::all();

        return view('clientes.index')->with([
            'clientes' => $clientes,
        ]);
    }

    public function create() {
        //TODO
    }

    public function store(UserRequest $request) {
        //TODO
    }

    public function show(Cliente $cliente) {
        return view('clientes.show')->with([
            'cliente' => $cliente,
        ]);
    }

    public function edit(User $user) {
        //TODO
    }

    public function update(UserRequest $request, User $user) {
        //TODO
    }

    public function destroy(User $user) {
        //TODO
    }
}
