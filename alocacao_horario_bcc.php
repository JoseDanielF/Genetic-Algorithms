<?php

//Etapa 1: Representação do Indivíduo

    // Função que gera um indivíduo (alocação) para cada turma com base nas preferências e disponibilidades dos docentes e disciplinas
function individuo($turmas) {
    // O indivíduo é um array associativo onde a chave é a turma e o valor é uma matriz representando a alocação das disciplinas e docentes
    $individuo = [];

    // Loop pelas turmas
    foreach ($turmas as $turma => $info) {
        // Recupera informações sobre as vagas horárias e disciplinas para a turma atual
        $vagas_horarias = $info['vagas'];
        $disciplinas = $info['disciplinas'];

        // Cria uma matriz para representar os horários alocados inicialmente vazia por dia
        $horarios_alocados = [];
        $dias = array_unique(array_column($vagas_horarias, 'dia'));
        foreach($dias as $dia) {
            $horarios_alocados[$dia] = [];
        }

        // Loop pelas disciplinas da turma
        foreach ($disciplinas as $disciplina) {
            // Recupera informações sobre os docentes da disciplina atual
            if (isset($disciplina['docentes']) && is_array($disciplina['docentes'])) {
                $docentes = $disciplina['docentes'];
                $encontros_semanais = $disciplina['encontrosSemanais'];

                // Loop pelos docentes da disciplina atual
                foreach ($docentes as $docente) {
                    // Seleciona um docente
                    $docente_escolhido = $docente;
                    $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'];

                    // Aloca os encontros semanais da disciplina para o docente escolhido
                    for ($i = 0; $i < $encontros_semanais; $i++) {
                        // Seleciona uma vaga horária aleatória
                        $vaga_horaria_aleatoria = $vagas_horarias[array_rand($vagas_horarias)];
                        $dia = $vaga_horaria_aleatoria['dia'];

                        // Encontra um horário disponível para alocar a disciplina
                        $horario_disponivel = encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis);

                        // Se encontrar um horário disponível, aloca a disciplina para o docente escolhido na vaga horária escolhida
                        if ($horario_disponivel !== null) {
                            $horarios_alocados[$dia][] = [
                                'disciplina' => $disciplina['nome'],
                                'docente' => $docente_escolhido['nome'],
                                'horario' => $horario_disponivel,
                                
                            ];
                        }
                    }
                }

            }
            // Adiciona a alocação da turma atual ao indivíduo
            $individuo[$turma] = $horarios_alocados;
        }
    }
    // Retorna o indivíduo contendo as alocações de todas as turmas
    return $individuo;
}

     // Função que encontra um horário disponível para alocar a disciplina e o docente em questão
     function encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis) {
        // Lista de horários disponíveis
        $horarios = ['18:30_20:10', '20:10_21:50'];

        // Verifica se algum horário está disponível
        foreach ($horarios as $horario) {
            if (!in_array($dia, $dias_indisponiveis) && !in_array($horario, $horarios_alocados[$dia])) {
                return $horario;
            }
        }

        // Se não encontrar um horário disponível, retorna null
        return null;
    }

    // Função que verifica se um conjunto de horários consecutivos está ocupado
    function horario_ocupado($horarios_alocados, $dia, $horarios_disponiveis, $dias_consecutivos, $dias_indisponiveis) {
        // Loop para verificar os horários ocupados em busca de conflitos com o conjunto de horários consecutivos
        for ($i = 0; $i < count($horarios_alocados) - $dias_consecutivos + 1; $i++) {
            // Obtém um conjunto de horários consecutivos alocados
            $horarios_ocupados = array_slice($horarios_alocados, $i, $dias_consecutivos);

            // Verifica se há conflito de horário com o conjunto de horários consecutivos e os dias indisponíveis
            foreach ($horarios_ocupados as $horarios_turma) {
                foreach ($horarios_turma as $horario_disciplina) {
                    if ($horario_disciplina['horario'] === $horarios_disponiveis && in_array($dia, $dias_indisponiveis)) {
                        // Se houver conflito, retorna verdadeiro (horário ocupado)
                        return true;
                    }
                }
            }
        }

        // Se não houver conflitos, retorna falso (horário disponível)
        return false;
    }
//

// Etapa 2: Função de Aptidão e //Etapa 5: Aplicação das Restrições (Apos aplicação das restrições)

    function avaliar_aptidao($individuo, $turmas) {
        $total_conflitos = 0;

        // Loop pelos horários alocados de cada turma
        foreach ($individuo as $turma => $horarios_alocados) {
            // Loop pelos horários alocados em cada dia
            foreach ($horarios_alocados as $dia => $alocacoes) {
                // Loop pelas alocações de horários
                for ($i = 0; $i < count($alocacoes); $i++) {
                    for ($j = $i + 1; $j < count($alocacoes); $j++) {
                        // Se houver uma alocação no mesmo horário para a mesma disciplina ou para o mesmo docente, incrementa o total de conflitos
                        if ($alocacoes[$i]['horario'] === $alocacoes[$j]['horario'] && ($alocacoes[$i]['disciplina'] === $alocacoes[$j]['disciplina'] || $alocacoes[$i]['docente'] === $alocacoes[$j]['docente'])) {
                            $total_conflitos++;
                        }
                    }
                }
            }
        }
        // Retorna o total de conflitos
        return $total_conflitos;
    }
    

    // Função que seleciona o melhor indivíduo (alocação) dentro de uma população de indivíduos
    function selecionar_melhor_individuo($populacao, $turmas) {
        // Inicializa a variável que armazenará o melhor indivíduo e a melhor aptidão encontrada
        $melhor_individuo = null;
        $melhor_aptidao = PHP_INT_MAX;

        // Loop por todos os indivíduos da população
        foreach ($populacao as $individuo) {
            // Avalia a aptidão do indivíduo atual
            $aptidao = avaliar_aptidao($individuo, $turmas);

            // Se a aptidão do indivíduo atual for melhor do que a melhor aptidão encontrada até o momento
            // atualiza a melhor aptidão e o melhor indivíduo
            if ($aptidao < $melhor_aptidao) {
                $melhor_aptidao = $aptidao;
                $melhor_individuo = $individuo;
            }
        }

        // Retorna o melhor indivíduo encontrado na população
        return $melhor_individuo;
    }
//

// Etapa 3: População Inicial

    function criar_populacao_inicial($turmas, $tamanho_populacao) {
        $populacao = [];

        for ($i = 0; $i < $tamanho_populacao; $i++) {
            $individuo = individuo($turmas);
            $populacao[] = $individuo;
        }

        return $populacao;
    }

//

// Etapa 4: Operadores Genéticos

    // Seleção por torneio: seleciona k indivíduos aleatórios da população e retorna o melhor entre eles
    function selecao_torneio($populacao, $k, $turmas) {
        $indices_selecionados = array_rand($populacao, $k);
        $melhor_individuo = null;
        $melhor_aptidao = PHP_INT_MAX;

        foreach ($indices_selecionados as $indice) {
            $individuo = $populacao[$indice];
            $aptidao = avaliar_aptidao($individuo, $turmas);

            if ($aptidao < $melhor_aptidao) {
                $melhor_aptidao = $aptidao;
                $melhor_individuo = $individuo;
            }
        }

        return $melhor_individuo;
    }

    // Crossover de um ponto: seleciona um ponto aleatório e troca as partes dos dois pais
    function crossover_um_ponto($pai1, $pai2) {
        // Assumindo que pai1 e pai2 têm o mesmo número de elementos
        $ponto = rand(0, count($pai1) - 1);
        $filho1 = array_merge(array_slice($pai1, 0, $ponto), array_slice($pai2, $ponto));
        $filho2 = array_merge(array_slice($pai2, 0, $ponto), array_slice($pai1, $ponto));

        return [$filho1, $filho2];
    }

    // Mutação por troca: troca o valor de duas posições aleatórias no indivíduo
    function mutacao_troca($individuo, $turmas) {
        // Escolhe uma turma aleatória para mutar
        $turma = array_rand($individuo);

        // Gera uma nova alocação para a turma selecionada
        $nova_alocacao = individuo([$turma => $turmas[$turma]])[$turma];

        // Substitui a alocação da turma selecionada pela nova alocação
        $individuo[$turma] = $nova_alocacao;

        return $individuo;
    }

// 

// Etapa 5: Aplicação das Restrições
    // Atualização da função de avaliar aptidão com as restrições 
//


// Etapa 6: Critério de Parada
 // Numero de gerações que irão acontecer 
//

$turmas = [
    //1º PERIODO
    "Turma 1" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        
        "disciplinas" => [
            [
                "nome" => "Cálculo pra Computação I",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Marcius",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Introdução à Programação",
                "encontrosSemanais" => 3,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Luis",
                        "diasIndisponiveis" => ["Segunda", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Geometria Analítica",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Normando",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quinta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Introdução a Computação",
                "encontrosSemanais" => 1,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Terça", "Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Lógica Matemática",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
        ]
    ],

    //2º PERIODO

    "Turma 2" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Cálculo pra Computação II",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Sansuke",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Programação Orientada à Objetos",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Igor",
                        "diasIndisponiveis" => ["Terça", "Quarta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Algoritmos e Estruturas de Dados I",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Igor",
                        "diasIndisponiveis" => ["Segunda", "Quarta", "Quinta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Álgebra Linear",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Gersonilo",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quinta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Física para Computação",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Wellington",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
        ],
    ],

    //3º PERIODO

    "Turma 3" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Probabilidade e Estatística",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Romero",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Algoritmos e Estruturas de Dados II",
                "encontrosSemanais" => 2,
                "docentes " => [
                    [
                        "nome" => "Igor",
                        "diasIndisponiveis" => ["Terça", "Quarta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Sistemas Digitais",
                "encontrosSemanais" => 3,
                "docentes" => [
                    [
                        "nome" => "Helder",
                        "diasIndisponiveis" => ["Segunda", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Metodologia Científica",
                "encontrosSemanais" => 1,
                "docentes" => [
                    [
                        "nome" => "Leila (Letras)",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Matemática Discreta",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Gersonilo",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Inglês",
                "encontrosSemanais" => 1,
                "docentes" => [
                    [
                        "nome" => "Diana (Letras)",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta", "Quinta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
        ]
    ],

    //4º PERIODO

    "Turma 4" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Engenharia de Software",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "R. Andrade",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Arquitetura de Computadores",
                "encontrosSemanais" => 2,
                "docentes " => [
                    [
                        "nome" => "Helder",
                        "diasIndisponiveis" => ["Terça", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Paradigmas de Linguagens de Programação",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Segunda", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Banco de Dados",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Priscilla",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Projeto e Análise de Algoritmos",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Alvaro",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
        ]
    ],

    //5º PERIODO

    "Turma 5" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Teoria da Computação",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Maria",
                        "diasIndisponiveis" => ["Terça", "Quarta", "Sexta"],
                        "diasConsecutivos" => 0,
                    ],
                ]
            ],
            [
                "nome" => "Redes de Computadores",
                "encontrosSemanais" => 2,
                "docentes " => [
                    [
                        "nome" => "Kádna",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Sistemas de Informação e Tecnologias",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Assuero",
                        "diasIndisponiveis" => ["Segunda", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Inteligência Artificial",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Tiago",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Sistemas Operacionais",
                "encontrosSemanais" => 1,
                "docentes" => [
                    [
                        "nome" => "Sérgio",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta", "Quinta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
        ]
    ],

    //6º PERIODO

    "Turma 6" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Empreendorismo",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Assuero",
                        "diasIndisponiveis" => ["Terça", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,
                    ],
                ]
            ],
            [
                "nome" => "Compiladores",
                "encontrosSemanais" => 2,
                "docentes " => [
                    [
                        "nome" => "Maria",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Computação Gráfica",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Icaro",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Reconhecimento de Padrões",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Luis",
                        "diasIndisponiveis" => ["Segunda", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Sistemas Distribuídos",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Jean",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
        ]
    ],

    //7º PERIODO

    "Turma 7" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Computadores e Sociedade",
                "encontrosSemanais" => 1,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Terça", "Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,
                    ],
                ]
            ],
            [
                "nome" => "Interação Humano-Computador",
                "encontrosSemanais" => 2,
                "docentes " => [
                    [
                        "nome" => "R. Andrade",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Desenvolvimento e Execução de Projetos de Software",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Icaro",
                        "diasIndisponiveis" => ["Segunda", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Projeto de Desenvolvimento",
                "encontrosSemanais" => 3,
                "docentes" => [
                    [
                        "nome" => "R. Gusmão",
                        "diasIndisponiveis" => ["Segunda", "Terça"],
                        "diasConsecutivos" => 3,

                    ],
                ]
            ],
            [
                "nome" => "Modelagem de Dependabilidade de Sistemas Computacionais",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Jean",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
        ]
    ],

    //8º PERIODO

    "Turma 8" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "14:00_18:00"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Métodos de Pesquisa em Computação",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Kádna",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Aprendizagem de Máquina",
                "encontrosSemanais" => 1,
                "docentes " => [
                    [
                        "nome" => "Tiago",
                        "diasIndisponiveis" => ["Segunda", "Quarta", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
            [
                "nome" => "Banco de Dados Avançados",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Priscilla",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Sexta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Testes de Software",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Alvaro",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quarta"],
                        "diasConsecutivos" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Redes Neurais",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Luis",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quinta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
        ]
    ],

    //9º PERIODO

    "Turma 9" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30_20:10"],
            ["dia" => "Segunda", "horario" => "20:10_21:50"],
            ["dia" => "Terça", "horario" => "14:00_18:00"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
            ["dia" => "Sexta", "horario" => "18:30_20:10"],
            ["dia" => "Sexta", "horario" => "20:10_21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Segurança de Redes de Computadores",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Sérgio",
                        "diasIndisponiveis" => ["Segunda", "Quarta", "Sexta"],
                        "diasConsecutivos" => 0,
                    ],
                ]
            ],
            [
                "nome" => "Estágio Supervisionado Obrigatório",
                "encontrosSemanais" => 1,
                "docentes " => [
                    [
                        "nome" => "R. Gusmão",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quinta", "Sexta"],
                        "diasConsecutivos" => 0,

                    ],
                ]
            ],
        ]
    ],
];


// Parâmetros
$tamanho_populacao = 100;
$numero_geracoes = 500;
$taxa_cruzamento = 0.8;
$taxa_mutacao = 0.05;

// Criação da população inicial
$populacao = [];
for ($i = 0; $i < $tamanho_populacao; $i++) {
    $populacao[] = individuo($turmas);
}

$melhor_aptidao = PHP_INT_MAX;
$geracoes_sem_melhora = 0;

for ($geracao = 0; $geracao < $numero_geracoes; $geracao++) {
    // Avaliação da aptidão
    $aptidoes = [];
    foreach ($populacao as $individuo) {
        $aptidoes[] = avaliar_aptidao($individuo, $turmas);
    }

    // Verifica se a aptidão do melhor indivíduo melhorou
    $melhor_aptidao_atual = min($aptidoes);
    if ($melhor_aptidao_atual < $melhor_aptidao) {
        $melhor_aptidao = $melhor_aptidao_atual;
        $geracoes_sem_melhora = 0;
    } else {
        $geracoes_sem_melhora++;
    }
}

// Seleção do melhor indivíduo da última geração
$melhor_individuo = selecionar_melhor_individuo($populacao, $turmas);
// $conteudo_txt = print_r($melhor_individuo, true);
// file_put_contents('horario.txt', $conteudo_txt, FILE_APPEND);
foreach ($melhor_individuo as $turma => $horarios) {
    $conteudo_txt .= "Horário da $turma\n";
    $dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta"];
    foreach ($dias as $dia) {
        $conteudo_txt .= "$dia:\n";
        foreach ($horarios as $horario) {
            if ($horario['dia'] == $dia) {
                $conteudo_txt .= "{$horario['horario']}: {$horario['disciplina']} ({$horario['docente']})\n";
            }
        }
    }
    $conteudo_txt .= "\n";
}
file_put_contents('horario.txt', $conteudo_txt, LOCK_EX);


?>