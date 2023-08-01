<?php

//REPRESENTAÇÃO DOS DOCENTES E MATERIAS DO CURSO DE BCC
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
                "docentes" => [
                    [
                        "nome" => "Marcius",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Introdução à Programação",
                "encontrosSemanais" => 3,
                "docentes" => [
                    [
                        "nome" => "Luis, Renê",
                        "diasIndisponiveis" => ["Segunda"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Geometria Analítica",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Normando",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Quinta"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Introdução a Computação",
                "encontrosSemanais" => 1,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Lógica Matemática",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Gersonilo",
                        "diasIndisponiveis" => ["Segunda", "Terça"],
                       
                        "encontrosPorDia" => 2,

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
                "docentes" => [
                    [
                        "nome" => "Sansuke",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Programação Orientada à Objetos",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Igor",
                        "diasIndisponiveis" => ["Quarta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Algoritmos e Estruturas de Dados I",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Igor, Renê",
                        "diasIndisponiveis" => ["Quarta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Álgebra Linear",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Gersonilo",
                        "diasIndisponiveis" => ["Segunda", "Terça"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Física para Computação",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Wellington",
                        "diasIndisponiveis" => ["Segunda", "Terça", "Sexta"],
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Algoritmos e Estruturas de Dados II",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Igor",
                        "diasIndisponiveis" => ["Quarta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Sistemas Digitais",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Helder",
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Matemática Discreta",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Gersonilo",
                    "diasIndisponiveis" => ["Segunda", "Terça"],
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Arquitetura de Computadores",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Helder",
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Paradigmas de Linguagens de Programação",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Banco de Dados",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Priscilla",
                        "diasIndisponiveis" => ["Segunda", "Terça"],
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,


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
                        "diasIndisponiveis" => ["Quarta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

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
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Sistemas de Informação e Tecnologias",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Assuero",
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Inteligência Artificial",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Tiago",
                        "diasIndisponiveis" => ["Segunda", "Sexta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Sistemas Operacionais",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Sérgio",
                        "diasIndisponiveis" => ["Segunda", "Quarta"],
                       
                        "encontrosPorDia" => 2,


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
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Compiladores",
                "encontrosSemanais" => 2,
                "docentes " => [
                    [
                        "nome" => "Maria",
                        "diasIndisponiveis" => ["Quarta", "Sexta"],
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Reconhecimento de Padrões",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Luis",
                    "diasIndisponiveis" => ["Segunda"],
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,


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
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Interação Humano-Computador",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "R. Andrade",
                        "diasIndisponiveis" => ["Quarta", "Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Desenvolvimento e Execução de Projetos de Software",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Ryan",
                        "diasIndisponiveis" => ["Quinta", "Sexta"],
                       
                        "encontrosPorDia" => 2,

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
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,


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
                       
                        "encontrosPorDia" => 2,

                    ],
                ]
            ],
            [
                "nome" => "Aprendizagem de Máquina",
                "encontrosSemanais" => 1,
                "encontrosMesmoDia" => true,
                "docentes" => [
                    [
                        "nome" => "Tiago",
                        "diasIndisponiveis" => ["Segunda", "Sexta"],
                       
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Banco de Dados Avançados",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Priscilla",
                        "diasIndisponiveis" => ["Segunda", "Terça"],
                       
                        "encontrosPorDia" => 2,


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
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
            [
                "nome" => "Redes Neurais",
                "encontrosSemanais" => 2,
                "docentes" => [
                    [
                        "nome" => "Luis",
                        "diasIndisponiveis" => ["Segunda"],
                        "encontrosPorDia" => 2,


                    ],
                ]
            ],
        ]
    ],

    //9º PERIODO

    "Turma 9" => [
        "vagas" => [
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
                        "diasIndisponiveis" => ["Segunda", "Quarta"],
                       
                        "encontrosPorDia" => 2,
                    ],
                ]
            ],
            [
                "nome" => "Estágio Supervisionado Obrigatório",
                "encontrosSemanais" => 1,
                "docentes" => [
                    [
                        "nome" => "R. Gusmão",
                        "diasIndisponiveis" => ["Segunda", "Terça"],
                       
                        "encontrosPorDia" => 1,
                    ],
                ]
            ],
            [
                "nome" => "Aprendizagem de Máquina",
                "encontrosSemanais" => 2,
                "encontrosMesmoDia" => true,
                "docentes " => [
                    [
                        "nome" => "Tiago",
                        "diasIndisponiveis" => ["Segunda", "Sexta"],
                       
                        "encontrosPorDia" => 2,
                    ],
                ]
            ],
        ]
    ],
];

//Etapa 1: Representação do Indivíduo

// Função que gera um indivíduo (alocação) para cada turma com base nas preferências e disponibilidades dos docentes e disciplinas
function individuo($turmas) {
    $individuo = [];
    $horarios_docentes = [];

    foreach ($turmas as $turma => $info) {
        $vagas_horarios = $info['vagas'];
        $disciplinas = $info['disciplinas'];

        $horarios_alocados = [];
        $ultimo_horario_alocado = [];
        $dias = array_unique(array_column($vagas_horarios, 'dia'));

        foreach($dias as $dia) {
            $horarios_alocados[$dia] = [];
            $ultimo_horario_alocado[$dia] = null;
        }

        foreach ($disciplinas as $disciplina) {
            if (isset($disciplina['docentes'])) {
                $docentes = $disciplina['docentes'];
                $encontros_semanais = $disciplina['encontrosSemanais'];
        
                foreach ($docentes as $docente) {
                    $docente_escolhido = $docente;
                    $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'] ?? []; 
                    $encontrosPorDia = $docente_escolhido['encontrosPorDia'];
                    $aulas_docente_semana = 0;

                    for ($i = 0; $i < $encontros_semanais; $i++) {
                        foreach($dias as $dia) {
                            if (!in_array($dia, $dias_indisponiveis) && count($horarios_alocados[$dia]) < $encontrosPorDia) {
                                $horario_disponivel = encontrar_horario_disponivel($vagas_horarios, $horarios_alocados, $dia, $ultimo_horario_alocado, $docente_escolhido['nome'], $horarios_docentes);

                                if ($horario_disponivel !== null && $aulas_docente_semana < $encontros_semanais) {
                                    $horarios_alocados[$dia][] = [
                                        'disciplina' => $disciplina['nome'],
                                        'docente' => $docente_escolhido['nome'],
                                        'horario' => $horario_disponivel,
                                    ];
                                    $ultimo_horario_alocado[$dia] = $horario_disponivel;
                                    $aulas_docente_semana++;

                                    // Adiciona este horário aos horários ocupados do docente
                                    if (!isset($horarios_docentes[$docente_escolhido['nome']])) {
                                        $horarios_docentes[$docente_escolhido['nome']] = [];
                                    }
                                    if (!isset($horarios_docentes[$docente_escolhido['nome']][$dia])) {
                                        $horarios_docentes[$docente_escolhido['nome']][$dia] = [];
                                    }
                                    $horarios_docentes[$docente_escolhido['nome']][$dia][] = $horario_disponivel;
                                }
                            }
                        }
                    }
                }
            }
        }
        $individuo[$turma] = $horarios_alocados;
    }

    return $individuo;
}



function todas_disciplinas_alocadas($individuo, $turmas) {
    // Extrair todas as disciplinas
    $todas_disciplinas = [];
    foreach ($turmas as $turma) {
        foreach ($turma['disciplinas'] as $disciplina) {
            $todas_disciplinas[] = $disciplina['nome'];
        }
    }
    // Verificar se todas as disciplinas estão no indivíduo
    foreach ($individuo as $turma) {
        foreach ($turma as $dia) {
            foreach ($dia as $aula) {
                if (($key = array_search($aula['disciplina'], $todas_disciplinas)) !== false) {
                    unset($todas_disciplinas[$key]);
                }
            }
        }
    }
    return count($todas_disciplinas) === 0;
}

// Função que encontra um horário disponível para alocar a disciplina e o docente em questão
function encontrar_horario_disponivel($vagas_horarios, $horarios_alocados, $dia, $ultimo_horario_alocado, $docente_escolhido, $horarios_docentes)
{
    // Loop pelos horários disponíveis no dia
    foreach ($vagas_horarios as $vaga) {
        if ($vaga['dia'] === $dia && (!isset($ultimo_horario_alocado[$dia]) || $vaga['horario'] > $ultimo_horario_alocado[$dia])) {
            // Verifica se o horário já está ocupado
            if (!horario_ocupado($horarios_alocados, $dia, $vaga['horario'])) {
                // Verifica se o docente não está ocupado neste horário
                if (!isset($horarios_docentes[$docente_escolhido]) || !isset($horarios_docentes[$docente_escolhido][$dia]) || !in_array($vaga['horario'], $horarios_docentes[$docente_escolhido][$dia])) {
                    return $vaga['horario'];
                }
            }
        }
    }

    return null;
}

// Função que verifica se um horário está ocupado por uma disciplina ou docente em particular
function horario_ocupado($horarios_alocados, $dia, $horario)
{
    if (isset($horarios_alocados[$dia])) {
        foreach ($horarios_alocados[$dia] as $alocacao) {
            if ($alocacao['horario'] == $horario) {
                return true;
            }
        }
    }

    return false;
}
//

// Etapa 2: Função de Aptidão e //Etapa 5: Aplicação das Restrições (Apos aplicação das restrições)
function avaliar_aptidao($individuo, $turmas)
{
    $total_conflitos = 0;
    $aulas_por_disciplina = [];
    $aulas_por_professor_por_dia = [];

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

                // Contabiliza aulas por disciplina
                if (!isset($aulas_por_disciplina[$turma][$alocacao['disciplina']])) {
                    $aulas_por_disciplina[$turma][$alocacao['disciplina']] = 0;
                }
                $aulas_por_disciplina[$turma][$alocacao['disciplina']]++;

                // Contabiliza aulas por professor por dia
                if (!isset($aulas_por_professor_por_dia[$alocacao['docente']])) {
                    $aulas_por_professor_por_dia[$alocacao['docente']] = [];
                }
                if (!isset($aulas_por_professor_por_dia[$alocacao['docente']][$dia])) {
                    $aulas_por_professor_por_dia[$alocacao['docente']][$dia] = 0;
                }
                $aulas_por_professor_por_dia[$alocacao['docente']][$dia]++;
            }
        }
    }

    // Verifica se todas as disciplinas de cada turma foram alocadas
    foreach ($turmas as $turma => $info) {
        foreach ($info['disciplinas'] as $disciplina) {
            if (!isset($aulas_por_disciplina[$turma][$disciplina['nome']])) {
                $total_conflitos++;
            } else if ($aulas_por_disciplina[$turma][$disciplina['nome']] < $disciplina['encontrosSemanais']) {
                $total_conflitos += $disciplina['encontrosSemanais'] - $aulas_por_disciplina[$turma][$disciplina['nome']];
            }
        }
    }

    // Verifica se as aulas de cada professor estão distribuídas uniformemente ao longo da semana
    foreach ($aulas_por_professor_por_dia as $aulas_professor) {
        $media_aulas = array_sum($aulas_professor) / count($aulas_professor);
        foreach ($aulas_professor as $aulas_dia) {
            if ($aulas_dia > $media_aulas) {
                $total_conflitos++;
            }
        }
    }

    // Retorna o total de conflitos
    return $total_conflitos;
}

//

// Função que seleciona o melhor indivíduo (alocação) dentro de uma população de indivíduos
function selecionar_melhor_individuo($populacao, $turmas)
{
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
function criar_populacao_inicial($turmas, $tamanho_populacao)
{
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
function selecao_torneio($populacao, $k, $turmas)
{
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
function crossover_um_ponto($pai1, $pai2)
{
    // Assumindo que pai1 e pai2 têm o mesmo número de elementos
    $ponto = rand(0, count($pai1) - 1);
    $filho1 = array_merge(array_slice($pai1, 0, $ponto), array_slice($pai2, $ponto));
    $filho2 = array_merge(array_slice($pai2, 0, $ponto), array_slice($pai1, $ponto));

    return [$filho1, $filho2];
}

// Mutação por troca: troca o valor de duas posições aleatórias no indivíduo
function mutacao_troca($individuo, $turmas)
{
    // Escolhe uma turma aleatória para mutar
    $turma = array_rand($individuo);

    // Se a turma escolhida tem pelo menos dois dias com horários alocados, prossiga com a mutação
    if (count($individuo[$turma]) >= 2) {
        // Escolhe dois dias aleatórios para trocar horários
        $dias = array_rand($individuo[$turma], 2);

        // Certifique-se de que os dias escolhidos têm pelo menos um horário alocado
        if(count($individuo[$turma][$dias[0]]) > 0 && count($individuo[$turma][$dias[1]]) > 0) {
            // Escolhe um horário aleatório de cada dia para trocar
            $horario1 = array_rand($individuo[$turma][$dias[0]]);
            $horario2 = array_rand($individuo[$turma][$dias[1]]);

            // Verificar se a troca é válida (não resulta em um professor dando duas aulas ao mesmo tempo)
            $docente1 = $individuo[$turma][$dias[0]][$horario1]['docente'];
            $docente2 = $individuo[$turma][$dias[1]][$horario2]['docente'];

            if(!horario_ocupado($individuo, $dias[1], $horario2, $docente1) && !horario_ocupado($individuo, $dias[0], $horario1, $docente2)) {
                // Realiza a troca dos horários
                $temp = $individuo[$turma][$dias[0]][$horario1];
                $individuo[$turma][$dias[0]][$horario1] = $individuo[$turma][$dias[1]][$horario2];
                $individuo[$turma][$dias[1]][$horario2] = $temp;
            }
        }
    }

    return $individuo;
}
// 

// Etapa 5: Aplicação das Restrições
// Atualização da função de avaliar aptidão com as restrições 
//


// Etapa 6: Critério de Parada
// Numero de gerações que irão acontecer 
//

// Parâmetros
$tamanho_populacao = 12;
$inicio = time();
$limite = 10 * 60;

// Criação da população inicial
$populacao = criar_populacao_inicial($turmas, $tamanho_populacao);

$melhor_aptidao = PHP_INT_MAX;
$geracoes_sem_melhora = 0;

// Enquanto a aptidão do melhor indivíduo não for perfeita
while ($melhor_aptidao > 0 && time() - $inicio < $limite && $geracoes_sem_melhora < 100) {
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
    $filhos = crossover_um_ponto($pais[0], $pais[1]);

    // Etapa de mutação
    for ($i = 0; $i < count($filhos); $i++) {
        $filhos[$i] = mutacao_troca($filhos[$i], $turmas);
    }

    // Verificar se todas as disciplinas estão alocadas
    for ($i = 0; $i < count($filhos); $i++) {
        if (!todas_disciplinas_alocadas($filhos[$i], $turmas)) {
            // Se uma disciplina não estiver alocada, realize uma mutação
            $filhos[$i] = mutacao_troca($filhos[$i], $turmas);
        }
    }

    // Substitui um percentual da população antiga pelos novos filhos
    $percentual_substituicao = 0.2;
    $quantidade_substituir = round($tamanho_populacao * $percentual_substituicao);

    // Ordena a população pelo aptidão
    usort($populacao, function ($a, $b) use ($turmas) {
        return avaliar_aptidao($a, $turmas) <=> avaliar_aptidao($b, $turmas);
    });

    // Substitui os piores indivíduos pelos filhos
    for ($i = 0; $i < $quantidade_substituir; $i++) {
        $populacao[$tamanho_populacao - $i - 1] = $filhos[$i];
    }

    // Reordena a população
    usort($populacao, function ($a, $b) use ($turmas) {
        return avaliar_aptidao($a, $turmas) <=> avaliar_aptidao($b, $turmas);
    });
    $populacao = array_slice($populacao, 0, $tamanho_populacao);
}


// Seleção do melhor indivíduo da última geração
$melhor_individuo = selecionar_melhor_individuo($populacao, $turmas);
$conteudo_txt = "";

foreach ($melhor_individuo as $turma => $dias) {
    $conteudo_txt .= "Horário da $turma\n";
    foreach ($dias as $dia => $horarios) {
        $conteudo_txt .= "$dia:\n";
        foreach ($horarios as $horario) {
            $conteudo_txt .= "{$horario['horario']}: {$horario['disciplina']} ({$horario['docente']})\n";
        }
    }
    $conteudo_txt .= "\n";
}
file_put_contents('horario.txt', $conteudo_txt);

?>
