<?php

$turmas = [
    // Cada turma tem um número fixo de vagas de horários
    // Cada vaga tem um horário e um dia da semana
    // Não existe choque de horário entre as vagas de uma turma

    //1º PERIODO
    "Turma 1" => [
        "vagas" => [
            ["dia" => "Segunda", "horario" => "18:30"],
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
            ["dia" => "Sexta", "horario" => "20:10"],
            ["dia" => "Sexta", "horario" => "21:00"],
            ["dia" => "Sexta", "horario" => "21:50"],
        ],
        // Cada turma tem um conjunto de disciplinas
        // Cada disciplina tem um número de encontros semanais
        // Algumas disciplinas não podem ter mais de um encontro por dia
        // Algumas disciplinas devem ter todos os encontros no mesmo dia
        // Cada disciplina tem um ou mais docentes alocados
        // O algoritmo deve considerar restrições de horários dos docentes
        // Alguns docentes não podem lecionar em dias específicos da semana
        // Alguns docentes devem ter suas aulas concentradas em 2 ou 3 dias consecutivos
        // Cada docente pode lecionar um conjunto limitado de disciplinas
        // Quanto menos dias consecutivos ficar cada docente, melhor é a solução
        // As restrições precisam ser satisfeitas
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Segunda", "horario" => "20:10"],
            ["dia" => "Segunda", "horario" => "21:00"],
            ["dia" => "Segunda", "horario" => "21:50"],
            ["dia" => "Terça", "horario" => "18:30"],
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
            ["dia" => "Quinta", "horario" => "20:10"],
            ["dia" => "Quinta", "horario" => "21:00"],
            ["dia" => "Quinta", "horario" => "21:50"],
            ["dia" => "Sexta", "horario" => "18:30"],
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
            ["dia" => "Terça", "horario" => "20:10"],
            ["dia" => "Terça", "horario" => "21:00"],
            ["dia" => "Terça", "horario" => "21:50"],
            ["dia" => "Quarta", "horario" => "18:30"],
            ["dia" => "Quarta", "horario" => "20:10"],
            ["dia" => "Quarta", "horario" => "21:00"],
            ["dia" => "Quarta", "horario" => "21:50"],
            ["dia" => "Quinta", "horario" => "18:30"],
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