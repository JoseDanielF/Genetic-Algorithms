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

        // Cria uma matriz para representar os horários alocados inicialmente vazia
        $horarios_alocados = array_fill(0, count($vagas_horarias), []);

        // Loop pelas disciplinas da turma
        foreach ($disciplinas as $disciplina) {
            // Recupera informações sobre os docentes da disciplina atual
            $docentes = $disciplina['docentes'];
            $encontros_semanais = $disciplina['encontrosSemanais'];
            $encontros_mesmo_dia = $disciplina['encontrosMesmoDia'];

            // Loop pelos docentes da disciplina atual
            foreach ($docentes as $docente) {
                // Seleciona um docente
                $docente_escolhido = $docente;
                $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'];
                $dias_consecutivos = $docente_escolhido['diasConsecutivos'];

                // Aloca os encontros semanais da disciplina para o docente escolhido
                for ($i = 0; $i < $encontros_semanais; $i++) {
                    // Seleciona uma vaga horária aleatória
                    $vaga_horaria_aleatoria = $vagas_horarias[array_rand($vagas_horarias)];
                    $dia = $vaga_horaria_aleatoria['dia'];

                    // Se a disciplina tiver encontros no mesmo dia, encontra a próxima vaga horária no mesmo dia
                    if ($encontros_mesmo_dia) {
                        $indice_dia = array_search($vaga_horaria_aleatoria, $vagas_horarias);
                        for ($j = 1; $j < $encontros_semanais; $j++) {
                            $vaga_horaria_aleatoria = $vagas_horarias[$indice_dia + $j];
                        }
                    }

                    // Encontra um horário disponível para alocar a disciplina
                    $horarios_disponiveis = encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis, $dias_consecutivos);

                    // Se encontrar um horário disponível, aloca a disciplina para o docente escolhido na vaga horária escolhida
                    if ($horarios_disponiveis !== null && count($horarios_disponiveis) > 0) {
                        $horario_escolhido = $horarios_disponiveis[array_rand($horarios_disponiveis)];
                        $horarios_alocados[array_search($vaga_horaria_aleatoria, $vagas_horarias)][] = [
                            'disciplina' => $disciplina['nome'],
                            'docente' => $docente_escolhido['nome'],
                            'horario' => $horario_escolhido
                        ];
                    }
                }
            }
        }

        // Adiciona a alocação da turma atual ao indivíduo
        $individuo[$turma] = $horarios_alocados;
    }

    // Retorna o indivíduo contendo as alocações de todas as turmas
    return $individuo;
}

// Função que encontra um horário disponível para alocar a disciplina e o docente em questão
function encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis, $dias_consecutivos) {
    // Lista de horários disponíveis
    $horarios = [
        '18:30',
        '19:20',
        '20:10',
        '21:00',
        '21:50'
    ];

    // Se não houver horários suficientes para alocar os dias consecutivos, retorna null
    if (count($horarios) < $dias_consecutivos) {
        return null;
    }

    // Loop para encontrar um conjunto de horários consecutivos disponíveis para alocar a disciplina
    for ($i = 0; $i < count($horarios) - $dias_consecutivos + 1; $i++) {
        // Obtém um conjunto de horários consecutivos
        $horarios_disponiveis = array_slice($horarios, $i, $dias_consecutivos);

        // Verifica se o conjunto de horários consecutivos não está ocupado
        if (!horario_ocupado($horarios_alocados, $dia, $horarios_disponiveis, $dias_consecutivos, $dias_indisponiveis)) {
            // Se estiver disponível, retorna o conjunto de horários
            return $horarios_disponiveis;
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

// Etapa 2: Função de Aptidão


// Função que avalia a aptidão de um indivíduo, aplicando penalidades às alocações que não atendem às restrições
function avaliar_aptidao($individuo, $turmas) {
    // Variável para armazenar a penalidade total
    $penalidade_total = 0;

    // Loop pelas turmas
    foreach ($turmas as $turma => $info) {
        // Recupera informações sobre as vagas horárias, disciplinas e horários alocados para a turma atual
        $vagas = $info['vagas'];
        $disciplinas = $info['disciplinas'];
        $horarios_alocados = $individuo[$turma];

        // Loop pelas disciplinas da turma
        foreach ($disciplinas as $disciplina) {
            // Recupera informações sobre os docentes da disciplina atual
            $docentes = $disciplina['docentes'];
            $encontros_semanais = $disciplina['encontrosSemanais'];
            $encontros_mesmo_dia = $disciplina['encontrosMesmoDia'];

            // Loop pelos docentes da disciplina atual
            foreach ($docentes as $docente) {
                // Seleciona um docente
                $docente_escolhido = $docente;
                $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'];
                $dias_consecutivos = $docente_escolhido['diasConsecutivos'];

                // Variável para armazenar os dias alocados
                $dias_alocados = [];

                // Aloca os encontros semanais da disciplina para o docente escolhido
                for ($i = 0; $i < $encontros_semanais; $i++) {
                    // Seleciona um dia aleatório da semana
                    $dia_aleatorio = $vagas[array_rand($vagas)];
                    $dia = $dia_aleatorio['dia'];

                    // Se a disciplina tiver encontros no mesmo dia, encontra o próximo dia da semana
                    if ($encontros_mesmo_dia) {
                        $indice_dia = array_search($dia_aleatorio, $vagas);
                        for ($j = 1; $j < $encontros_semanais; $j++) {
                            $dia_aleatorio = $vagas[$indice_dia + $j];
                        }
                    }

                    // Encontra um horário disponível para alocar a disciplina
                    $horarios_disponiveis = encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis, $dias_consecutivos);

                    // Se encontrar um horário disponível, aloca a disciplina para o docente escolhido na vaga horária escolhida
                    if ($horarios_disponiveis !== null && count($horarios_disponiveis) > 0) {
                        $horario_escolhido = $horarios_disponiveis[array_rand($horarios_disponiveis)];
                        $horarios_alocados[array_search($dia_aleatorio, $vagas)][] = [
                            'disciplina' => $disciplina['nome'],
                            'docente' => $docente_escolhido['nome'],
                            'horario' => $horario_escolhido
                        ];
                        $dias_alocados[] = $dia;
                    } else {
                        // Se não encontrar horário disponível, aplica uma penalidade de 1000
                        $penalidade_total += 1000;
                    }
                }

                // Penalidade para dias consecutivos
                if (count($dias_alocados) >= 2) {
                    for ($i = 0; $i < count($dias_alocados) - 1; $i++) {
                        if (date('N', strtotime($dias_alocados[$i + 1])) - date('N', strtotime($dias_alocados[$i])) <= 1) {
                            // Se houver aulas consecutivas em dias próximos, aplica uma penalidade de 500
                            $penalidade_total += 500;
                        }
                    }
                }
            }
        }
    }

    // Retorna a penalidade total do indivíduo (quanto menor, melhor é a alocação)
    return $penalidade_total;
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

// Etapa 3: População Inicial

function criar_populacao_inicial($turmas, $tamanho_populacao) {
    $populacao = [];

    for ($i = 0; $i < $tamanho_populacao; $i++) {
        $individuo = individuo($turmas);
        $populacao[] = $individuo;
    }

    return $populacao;
}



$turmas = [
    //1º PERIODO
    "Turma 1" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
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
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
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
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Probabilidade e Estatística",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Engenharia de Software",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Teoria da Computação",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Empreendorismo",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Computadores e Sociedade",
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
                "nome" => "Interação Humano-Computador",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
            ["dia" => "Segunda", "horario" => "14:00"],
            ["dia" => "Segunda", "horario" => "18:00"],
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "19:20"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "19:20"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Métodos de Pesquisa em Computação",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "19:20"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "19:20"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "19:20"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
        ],
        "disciplinas" => [
            [
                "nome" => "Segurança de Redes de Computadores",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
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
                "encontrosMesmoDia" => true,
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

$tamanho_populacao = 50;
$populacao = criar_populacao_inicial($turmas, $tamanho_populacao);
print_r($populacao);

?>