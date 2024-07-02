<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\Servidor;
use App\Models\Servico;
use App\Models\Coordenacao;
use App\Models\AvaliacaoServidor;

use Illuminate\Support\Facades\Log;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaliacoes = Avaliacao::all();
        foreach ($avaliacoes as $avaliacao) {
            $avaliacao->nome_responsavel1 = Servidor::find($avaliacao->responsavel_1)->nome;
            $avaliacao->nome_responsavel2 = Servidor::find($avaliacao->responsavel_2)->nome;
        }

        return view('avaliacao.index', compact('avaliacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anoAtual = date('Y');
        return view('avaliacao.create', compact('anoAtual'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avaliacao = new Avaliacao;
        $avaliacao->ano_referencia = $request->input('ano_referencia');
        $avaliacao->inicio_periodo_avaliado = $request->input('inicio_periodo_avaliado');
        $avaliacao->fim_periodo_avaliado = $request->input('fim_periodo_avaliado');
        $avaliacao->responsavel_1 = $request->input('responsavel_1');
        $avaliacao->responsavel_2 = $request->input('responsavel_2');

        $avaliacao->save();
        return redirect()->route('avaliacao.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Avaliacao $avaliacao)
    {
        return view('avaliacao.show', compact('avaliacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avaliacao $avaliacao)
    {
        return view('avaliacao.edit', compact('avaliacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avaliacao $avaliacao)
    {
        $avaliacao->update($request->all());
        return redirect()->route('avaliacao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avaliacao $avaliacao)
    {
        $avaliacao->delete();
        return redirect()->route('avaliacao.index');
    }

    public function sortear(Request $request)
    {
        // Valida o ano de referência
        $request->validate([
            'ano_referencia' => 'required|integer'
        ]);

        $ano_referencia = $request->input('ano_referencia');

        $this->sortearDiretor($ano_referencia);
        $this->sortearCoordenadores($ano_referencia);
        $this->sortearChefesServico($ano_referencia);
        $this->servidoresComuns($ano_referencia);
        // FAZER AUTOAVALIAÇÃO

        return 'Sorteio das avaliações finalizado com sucesso!';
    }

    // O DIRETOR AVALIA TODOS OS MENBROS DA DIREÇÃO + TODOS OS COORDENADORES
    private function sortearDiretor ($ano_referencia) 
    {
        // 1. Buscar o 'id' do servidor chefe da coordenacao de 'id'=2
        $coordenacao = Coordenacao::find(2);
        if ($coordenacao && $coordenacao->chefe) {
            $id_diretor = $coordenacao->chefe; // DIRETOR
        } else {
            return redirect()->back()->with('error', 'Chefe da coordenacao não encontrado.');
        }

        // 2. Buscar todos os 'id' que estão cadastrados como chefes na tabela coordenacao
        $chefesIds = Coordenacao::pluck('chefe')->toArray();
        // 3. Buscar os detalhes dos servidores correspondentes
        $servidoresChefes = Servidor::whereIn('id', $chefesIds)->get();

        // Para propósitos de depuração, exiba apenas os atributos dos servidores chefes
        $servidoresChefesCoordenacao = $servidoresChefes->reject(function ($servidor) use ($id_diretor) {
            return $servidor->id === 2 || $servidor->id === $id_diretor;
        })->map(function ($servidor) {
            return $servidor->attributesToArray();
        });

        $servidoresDiretoria = Servidor::getServidoresDiretoria($id_diretor);

        $avaliados = $servidoresChefesCoordenacao->merge($servidoresDiretoria);

        // Iniciar o processo de salvar as avaliações
        foreach ($avaliados as $avaliado) {
            // Lógica para salvar as avaliações na tabela avaliacao_servidores
            $avaliacaoServidor = new AvaliacaoServidor();
            $avaliacaoServidor->id_servidor_avaliador = $id_diretor;
            $avaliacaoServidor->id_servidor_avaliado = $avaliado['id'];
            $avaliacaoServidor->ano_referencia = $ano_referencia;
            $avaliacaoServidor->peso = 0.6;
            $avaliacaoServidor->save();
        }

        return "Avaliação dos diretores feita com sucesso!";
    }

    // OS COORDENADORES AVALIAM TODOS OS MEMBROS DA COORDENAÇÃO + CHEFES DE SERVIÇO
    private function sortearCoordenadores ($ano_referencia)
    {
        // PEGAR TODOS OS COORDENADORES
        $coordenacoes = $this->listarCoordenacoesComChefes();
        $servicos = $this->listarServicosComChefes();
        $servidoresServicoNaoSeAplica = $this->listarServidoresServicoNaoSeAplica();  
        
        $coordenacoes = collect($coordenacoes);
        //REMOVE A COORDENAÇÃO DIR E N/A
        $coordenacoes = $coordenacoes->reject(function ($coordenacao) {
            return $coordenacao['sigla'] === 'DIR' || $coordenacao['sigla'] === 'N/A';
        })->values();
        
        foreach ($coordenacoes as $coordenacao) {
            // COORDENADORES AVALIANDO CHEFES DE SERVIÇO
            foreach ($servicos as $servico) {
                if ($servico->coordenacao_id == $coordenacao->id) {
                    $avaliacaoServidor = new AvaliacaoServidor();
                    $avaliacaoServidor->id_servidor_avaliador   = $coordenacao->chefe;
                    $avaliacaoServidor->id_servidor_avaliado    = $servico->chefe;
                    $avaliacaoServidor->ano_referencia          = $ano_referencia;
                    $avaliacaoServidor->peso                    = 0.6;
                    $avaliacaoServidor->save();
                }
            }

            // COORDENADORES AVALIANDO SERVIDORES LIGADOS DIRETO A COORDENAÇÃO
            foreach ($servidoresServicoNaoSeAplica as $servidor) {
                if ($servidor->coordenacao_id == $coordenacao->id && $coordenacao->chefe != $servidor->id ) {
                    $avaliacaoServidor = new AvaliacaoServidor();
                    $avaliacaoServidor->id_servidor_avaliador   = $coordenacao->chefe;
                    $avaliacaoServidor->id_servidor_avaliado    = $servidor->id;
                    $avaliacaoServidor->ano_referencia          = $ano_referencia;
                    $avaliacaoServidor->peso                    = 0.6;
                    $avaliacaoServidor->save();
                }
            }
        }

        return "Avaliação dos coordenadores feita com sucesso!";
    }

    // OS CHEFES DE SERVIÇO AVALIAM TODOS OS QUE ESTÃO DENTRO DO SERVIÇO
    private function sortearChefesServico ($ano_referencia)
    { 
        $servicos = $this->listarServicosComChefes();
        $allServidores = $this->todosServidores();

        $servicos = collect($servicos);
        //REMOVE A COORDENAÇÃO DIR E N/A
        $servicos = $servicos->reject(function ($servico) {
            return $servico['sigla'] === 'N/A';
        })->values();

        foreach ($servicos as $servico) {
            foreach ($allServidores as $servidor) {
                if ($servico->chefe != 2) {
                    if ($servico->id == $servidor->servico_id && $servico->chefe != $servidor->id) {
                        $avaliacaoServidor = new AvaliacaoServidor();
                        $avaliacaoServidor->id_servidor_avaliador   = $servico->chefe;
                        $avaliacaoServidor->id_servidor_avaliado    = $servidor->id;
                        $avaliacaoServidor->ano_referencia          = $ano_referencia;
                        $avaliacaoServidor->peso                    = 0.6;
                        $avaliacaoServidor->save();
                    }
                }
            }
        }

        return $servicos;
        // return "Avaliação dos chefes de serviço feita com sucesso!";
    }

    public function servidoresComuns($ano_referencia)
    {
        $allServidores = Servidor::where('ativo',1)->get();
        $coordenacoes = $this->listarCoordenacoesComChefes();
        $servicos = $this->listarServicosComChefes();

        $coordenacoes = collect($coordenacoes);
        $servicos = collect($servicos);

        // Obtem os IDs dos chefes de coordenação e de serviço
        $chefesCoordenacaoIds  = $coordenacoes->pluck('chefe')->all();
        $chefesServicoIds  = $servicos->pluck('chefe')->all();

        // Combina todos os arrays dos chefes
        $chefesIds = array_merge($chefesCoordenacaoIds, $chefesServicoIds);

        // Filtra o array $servidores
        $servidoresFiltrados = $allServidores->reject(function ($servidor) use ($chefesIds) {
            return in_array($servidor->id, $chefesIds);
        })->values();

        foreach ($servidoresFiltrados as $servidor) {

            $posiveisAvaliados = $this->getSevidoresMesmoServico(
                $servidor->coordenacao_id,
                $servidor->servico_id,
                $servidor->id
            );

            

            collect($posiveisAvaliados);
            
            if (count($posiveisAvaliados)>3) {
                $avaliados = $posiveisAvaliados->random(3);
                foreach ($avaliados as $avaliado) {
                    $avaliacaoServidor = new AvaliacaoServidor();
                    $avaliacaoServidor->id_servidor_avaliador   = $servidor->id;
                    $avaliacaoServidor->id_servidor_avaliado    = $avaliado->id;
                    $avaliacaoServidor->ano_referencia          = $ano_referencia;
                    $avaliacaoServidor->peso                    = 0.25;
                    $avaliacaoServidor->save();
                }   
            } else {
                foreach ($posiveisAvaliados as $avaliado) {
                    $avaliacaoServidor = new AvaliacaoServidor();
                    $avaliacaoServidor->id_servidor_avaliador   = $servidor->id;
                    $avaliacaoServidor->id_servidor_avaliado    = $avaliado->id;
                    $avaliacaoServidor->ano_referencia          = $ano_referencia;
                    $avaliacaoServidor->peso                    = 0.25;
                    $avaliacaoServidor->save();
                }
            }
        }

        // $ret = $this->getSevidoresMesmoServico(3,3,2);
        // return $chefesIds;

        return "Avaliação dos servidores finalizada com sucesso!";
    }

    public function getSevidoresMesmoServico($coord, $serv, $id)
    {
        return Servidor::where('coordenacao_id',$coord)
                        ->where('servico_id', $serv)
                        ->where('id', '!=', $id)
                        ->where('ativo', 1)
                        ->get();
    }

    public function todosServidores()
    {
        return Servidor::whereNotIn('id', [1,2])->get(); // IGNORA OS IDS 1 E 2
    }

    public function listarCoordenacoesComChefes()
    {
        // Buscar todas as coordenações com seus respectivos chefes
        return Coordenacao::with('chefe')->get();
    }

    public function listarServicosComChefes()
    {
        // Buscar todos os serviços com seus respectivos chefes
        return Servico::with('chefe')->get();
    }

    public function listarServidoresServicoNaoSeAplica()
    {
        // Buscar servidores que estão ligados direto a coordenação
        return Servidor::where('servico_id', 2)
                ->where('ativo', 1)->get();
    }
}

