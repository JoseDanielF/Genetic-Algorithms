<?php

//Etapa 1: Representação do Indivíduo

function individuo($turmas) {
    $individuo = [];

    foreach ($turmas as $turma => $info) {
        $vagas_horarias = $info['vagas'];
        $disciplinas = $info['disciplinas'];
        $horarios_alocados = array_fill(0, count($vagas_horarias), []);

        foreach ($disciplinas as $disciplina) {
            $docentes = $disciplina['docentes'];
            $encontros_semanais = $disciplina['encontrosSemanais'];
            $encontros_mesmo_dia = $disciplina['encontrosMesmoDia'];

            foreach ($docentes as $docente) {
                $docente_escolhido = $docente;
                $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'];
                $dias_consecutivos = $docente_escolhido['diasConsecutivos'];

                for ($i = 0; $i < $encontros_semanais; $i++) {
                    $vaga_horaria_aleatoria = $vagas_horarias[array_rand($vagas_horarias)];
                    $dia = $vaga_horaria_aleatoria['dia'];

                    if ($encontros_mesmo_dia) {
                        $indice_dia = array_search($vaga_horaria_aleatoria, $vagas_horarias);
                        for ($j = 1; $j < $encontros_semanais; $j++) {
                            $vaga_horaria_aleatoria = $vagas_horarias[$indice_dia + $j];
                        }
                    }

                    $horarios_disponiveis = encontrar_horario_disponivel_unico($horarios_alocados, $dia, $dias_indisponiveis, $dias_consecutivos);

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

        $individuo[$turma] = $horarios_alocados;
    }

    return $individuo;
}

function encontrar_horario_disponivel_unico($horarios_alocados, $dia, $dias_indisponiveis, $dias_consecutivos) {
    $horarios = [
        '18:30',
        '20:10',
        '21:00',
        '21:50'
    ];

    if (count($horarios) < $dias_consecutivos) {
        return null;
    }

    for ($i = 0; $i < count($horarios) - $dias_consecutivos + 1; $i++) {
        $horarios_disponiveis = array_slice($horarios, $i, $dias_consecutivos);

        if (!horario_ocupado($horarios_alocados, $dia, $horarios_disponiveis, $dias_consecutivos, $dias_indisponiveis)) {
            return $horarios_disponiveis;
        }
    }

    return null; // Se não encontrar um horário disponível, retorna null
}

function horario_ocupado($horarios_alocados, $dia, $horarios_disponiveis, $dias_consecutivos, $dias_indisponiveis) {
    for ($i = 0; $i < count($horarios_alocados) - $dias_consecutivos + 1; $i++) {
        $horarios_ocupados = array_slice($horarios_alocados, $i, $dias_consecutivos);

        foreach ($horarios_ocupados as $horarios_turma) {
            foreach ($horarios_turma as $horario_disciplina) {
                if ($horario_disciplina['horario'] === $horarios_disponiveis && in_array($dia, $dias_indisponiveis)) {
                    return true;
                }
            }
        }
    }

    return false;
}

function avaliar_aptidao($individuo, $turmas) {
    // Vamos atribuir uma penalidade para cada violação de restrição no indivíduo
    $penalidade_total = 0;

    foreach ($turmas as $turma => $info) {
        $vagas = $info['vagas'];
        $disciplinas = $info['disciplinas'];
        $horarios_alocados = $individuo[$turma];

        foreach ($disciplinas as $disciplina) {
            $docentes = $disciplina['docentes'];
            $encontros_semanais = $disciplina['encontrosSemanais'];
            $encontros_mesmo_dia = $disciplina['encontrosMesmoDia'];

            foreach ($docentes as $docente) {
                $docente_escolhido = $docente;
                $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'];
                $dias_consecutivos = $docente_escolhido['diasConsecutivos'];

                $dias_alocados = [];

                for ($i = 0; $i < $encontros_semanais; $i++) {
                    $dia_aleatorio = $vagas[array_rand($vagas)];
                    $dia = $dia_aleatorio['dia'];

                    if ($encontros_mesmo_dia) {
                        $indice_dia = array_search($dia_aleatorio, $vagas);
                        for ($j = 1; $j < $encontros_semanais; $j++) {
                            $dia_aleatorio = $vagas[$indice_dia + $j];
                        }
                    }

                    $horarios_disponiveis = encontrar_horario_disponivel($horarios_alocados, $dia, $dias_indisponiveis, $dias_consecutivos);

                    if ($horarios_disponiveis !== null && count($horarios_disponiveis) > 0) {
                        $horario_escolhido = $horarios_disponiveis[array_rand($horarios_disponiveis)];
                        $horarios_alocados[array_search($dia_aleatorio, $vagas)][] = [
                            'disciplina' => $disciplina['nome'],
                            'docente' => $docente_escolhido['nome'],
                            'horario' => $horario_escolhido
                        ];
                        $dias_alocados[] = $dia;
                    } else {
                        // Se não encontrar horário disponível, aplicar penalidade
                        $penalidade_total += 1000;
                    }
                }

                // Penalidade para dias consecutivos
                if (count($dias_alocados) >= 2) {
                    for ($i = 0; $i < count($dias_alocados) - 1; $i++) {
                        if (date('N', strtotime($dias_alocados[$i + 1])) - date('N', strtotime($dias_alocados[$i])) <= 1) {
                            $penalidade_total += 500;
                        }
                    }
                }
            }
        }
    }

    return $penalidade_total;
}

function selecionar_melhor_individuo($populacao, $turmas) {
    $melhor_individuo = null;
    $melhor_aptidao = PHP_INT_MAX;

    foreach ($populacao as $individuo) {
        $aptidao = avaliar_aptidao($individuo, $turmas);
        if ($aptidao < $melhor_aptidao) {
            $melhor_aptidao = $aptidao;
            $melhor_individuo = $individuo;
        }
    }

    return $melhor_individuo;
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


$individuo = individuo($turmas);
print_r($individuo);

?>