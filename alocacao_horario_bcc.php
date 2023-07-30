<?php

//Etapa 1: Representação do Indivíduo

    // Função que gera um indivíduo (alocação) para cada turma com base nas preferências e disponibilidades dos docentes e disciplinas
    function individuo($turmas) {
        // Inicialização do indivíduo
        $individuo = [];
    
        // Loop por cada turma
        foreach ($turmas as $turma => $info) {
            // Recuperação das vagas horárias e disciplinas da turma atual
            $vagas_horarias = $info['vagas'];
            $disciplinas = $info['disciplinas'];
    
            // Inicialização dos horários alocados e do último horário alocado
            $horarios_alocados = [];
            $ultimo_horario_alocado = [];
    
            // Criação de uma lista dos dias das vagas horárias
            $dias = array_unique(array_column($vagas_horarias, 'dia'));
    
            // Inicialização dos horários alocados e do último horário alocado para cada dia
            foreach($dias as $dia) {
                $horarios_alocados[$dia] = [];
                $ultimo_horario_alocado[$dia] = null;
            }
    
            // Loop por cada disciplina da turma atual
            foreach ($disciplinas as $disciplina) {
                if (isset($disciplina['docentes']) && is_array($disciplina['docentes'])) {
                    // Recuperação dos docentes e do número de encontros semanais da disciplina atual
                    $docentes = $disciplina['docentes'];
                    $encontros_semanais = $disciplina['encontrosSemanais'];
    
                    // Loop por cada docente da disciplina atual
                    foreach ($docentes as $docente) {
                        $docente_escolhido = $docente;
                        $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'];
    
                        // Loop por cada encontro semanal da disciplina atual
                        for ($i = 0; $i < $encontros_semanais; $i++) {
                            foreach($dias as $dia) {
                                if (!in_array($dia, $dias_indisponiveis)) {
                                    // Procura um horário disponível para o docente no dia atual
                                    $horario_disponivel = encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis, $ultimo_horario_alocado, $disciplina['nome'], $docente_escolhido['nome']);
    
                                    if ($horario_disponivel !== null) {
                                        // Se um horário estiver disponível, aloca a disciplina para o docente no horário e dia atuais
                                        $horarios_alocados[$dia][] = [
                                            'disciplina' => $disciplina['nome'],
                                            'docente' => $docente_escolhido['nome'],
                                            'horario' => $horario_disponivel,
                                        ];
                                        // Atualiza o último horário alocado para o dia atual
                                        $ultimo_horario_alocado[$dia] = $horario_disponivel;
                                    }
                                }
                            }
                        }
                    }
                }
            }
    
            // Adiciona os horários alocados para a turma atual ao indivíduo
            $individuo[$turma] = $horarios_alocados;
        }
    
        // Retorna o indivíduo
        return $individuo;
    }

    // Função que encontra um horário disponível para alocar a disciplina e o docente em questão
    function encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis, $ultimo_horario_alocado, $disciplina, $docente) {
        // Lista de horários disponíveis
        $horarios = ['18:30_20:10', '20:10_21:50'];

        // Verifica se algum horário está disponível
        foreach ($horarios as $horario) {
            // Se o dia não está indisponível, o horário não foi alocado no dia atual e o horário é diferente do último horário alocado
            if (!in_array($dia, $dias_indisponiveis) && !horario_ocupado($horarios_alocados, $dia, $horario, $disciplina, $docente) && $horario != $ultimo_horario_alocado[$dia]) {
                return $horario;
            }
        }

        // Se não encontrar um horário disponível, retorna null
        return null;
    }
    

    // Função que verifica se um horário está ocupado por uma disciplina ou docente em particular
    function horario_ocupado($horarios_alocados, $dia, $horario, $disciplina, $docente) {
        if (isset($horarios_alocados[$dia])) {
            foreach ($horarios_alocados[$dia] as $alocacao) {
                if ($alocacao['horario'] == $horario && ($alocacao['disciplina'] == $disciplina || $alocacao['docente'] == $docente)) {
                    return true;
                }
            }
        }

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
                // Cria um array para armazenar as aulas alocadas para cada horário
                $aulas_por_horario = [];
                // Loop pelas alocações de horários
                foreach ($alocacoes as $alocacao) {
                    if (isset($alocacao['horario'])) {
                        $horario = $alocacao['horario'];
                    } else {
                        $horario = null;
                    }
                    // Se já existe uma aula alocada para o horário, incrementa o total de conflitos
                    if (isset($aulas_por_horario[$horario])) {
                        $total_conflitos++;
                    }
                    // Adiciona a alocação ao array de aulas por horário
                    $aulas_por_horario[$horario][] = $alocacao;
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
        // Seleciona k índices aleatórios da população
        $indices_selecionados = array_rand($populacao, $k);
    
        // Inicializa um array para armazenar os indivíduos selecionados com suas aptidões
        $selecionados = [];
        foreach ($indices_selecionados as $indice) {
            $selecionados[] = [
                'individuo' => $populacao[$indice],
                'aptidao' => avaliar_aptidao($populacao[$indice], $turmas),
            ];
        }
    
        // Ordena os selecionados pela aptidão em ordem ascendente (menor para maior)
        usort($selecionados, function ($a, $b) {
            return $a['aptidao'] - $b['aptidao'];
        });
    
        // Retorna os dois melhores indivíduos (os dois primeiros após a ordenação)
        return [$selecionados[0]['individuo'], $selecionados[1]['individuo']];
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
            ["dia" => "Terça", "horario" => "14:00_18:00"],
            ["dia" => "Terça", "horario" => "18:30_20:10"],
            ["dia" => "Terça", "horario" => "20:10_21:50"],
            ["dia" => "Quarta", "horario" => "18:30_20:10"],
            ["dia" => "Quarta", "horario" => "20:10_21:50"],
            ["dia" => "Quinta", "horario" => "18:30_20:10"],
            ["dia" => "Quinta", "horario" => "20:10_21:50"],
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
$tamanho_populacao = 500;
$taxa_cruzamento = 0.8;
$taxa_mutacao = 0.05;
$inicio = time();
$limite = 10 * 60;  // 10 minutos

// Criação da população inicial
$populacao = criar_populacao_inicial($turmas, $tamanho_populacao);

$melhor_aptidao = PHP_INT_MAX;
$geracoes_sem_melhora = 0;

// Enquanto a aptidão do melhor indivíduo não for perfeita
while ($melhor_aptidao > 0 && (time() - $inicio) < $limite) {
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

    // Etapa de seleção
$pais = selecao_torneio($populacao, 2, $turmas);

// Etapa de cruzamento
$filhos = [];
if (rand()/getrandmax() < $taxa_cruzamento) {
    $filhos = crossover_um_ponto($pais[0], $pais[1]);
} else {
    $filhos = $pais;
}

// Etapa de mutação
for ($i = 0; $i < count($filhos); $i++) {
    if (rand()/getrandmax() < $taxa_mutacao) {
        $filhos[$i] = mutacao_troca($filhos[$i], $turmas);
    }
}

// Substitui a população antiga pelos novos filhos
$populacao = array_merge($filhos, $populacao); 
usort($populacao, function($a, $b) use ($turmas) { return avaliar_aptidao($a, $turmas) <=> avaliar_aptidao($b, $turmas); });
$populacao = array_slice($populacao, 0, $tamanho_populacao);
}

// Seleção do melhor indivíduo da última geração
$melhor_individuo = selecionar_melhor_individuo($populacao, $turmas);
$conteudo_txt = print_r($melhor_individuo, true);
file_put_contents('horario.txt', $conteudo_txt);
// foreach ($melhor_individuo as $turma => $horarios) {
//     $conteudo_txt .= "Horário da $turma\n";
//     $dias = ["Segunda", "Terça", "Quarta", "Quinta", "Sexta"];
//     foreach ($dias as $dia) {
//         $conteudo_txt .= "$dia:\n";
//         foreach ($horarios as $horario) {
//             if ($horario['dia'] == $dia) {
//                 $conteudo_txt .= "{$horario['horario']}: {$horario['disciplina']} ({$horario['docente']})\n";
//             }
//         }
//     }
//     $conteudo_txt .= "\n";
// }
// file_put_contents('horario.txt', $conteudo_txt, LOCK_EX);


?>