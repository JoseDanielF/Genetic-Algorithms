<?php

//REPRESENTAÇÃO DOS DOCENTES E MATÉRIAS DO CURSO DE BCC
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

// Função para gerar um indivíduo na população.
function individuo($turmas) {
    // Inicializa a variável que armazena o indivíduo (a alocação de horários para todas as turmas).
    $individuo = [];
    // Inicializa a variável que armazena os horários ocupados por cada docente.
    $horarios_docentes = [];

    // Loop por cada turma.
    foreach ($turmas as $turma => $info) {
        // Obtém as vagas de horários e as disciplinas da turma atual.
        $vagas_horarios = $info['vagas'];
        $disciplinas = $info['disciplinas'];

        // Inicializa a variável que armazena os horários alocados para a turma atual.
        $horarios_alocados = [];
        // Inicializa a variável que armazena o último horário alocado para cada dia da semana.
        $ultimo_horario_alocado = [];
        // Obtém uma lista de todos os dias da semana que têm horários disponíveis.
        $dias = array_unique(array_column($vagas_horarios, 'dia'));

        // Inicializa os horários alocados e o último horário alocado para cada dia.
        foreach($dias as $dia) {
            $horarios_alocados[$dia] = [];
            $ultimo_horario_alocado[$dia] = null;
        }

        // Loop por cada disciplina.
        foreach ($disciplinas as $disciplina) {
            // Verifica se a disciplina tem docentes.
            if (isset($disciplina['docentes'])) {
                $docentes = $disciplina['docentes'];
                $encontros_semanais = $disciplina['encontrosSemanais'];
        
                // Loop por cada docente.
                foreach ($docentes as $docente) {
                    // Obtém as informações do docente.
                    $docente_escolhido = $docente;
                    $dias_indisponiveis = $docente_escolhido['diasIndisponiveis'] ?? []; 
                    $encontrosPorDia = $docente_escolhido['encontrosPorDia'];
                    $aulas_docente_semana = 0;

                    // Loop até que o docente seja alocado para o número necessário de encontros semanais.
                    for ($i = 0; $i < $encontros_semanais; $i++) {
                        // Loop por cada dia da semana.
                        foreach($dias as $dia) {
                            // Verifica se o dia atual não é um dia indisponível para o docente e se o docente ainda não foi alocado para o máximo de encontros por dia.
                            if (!in_array($dia, $dias_indisponiveis) && count($horarios_alocados[$dia]) < $encontrosPorDia) {
                                // Procura por um horário disponível para alocar o docente.
                                $horario_disponivel = encontrar_horario_disponivel($vagas_horarios, $horarios_alocados, $dia, $ultimo_horario_alocado, $docente_escolhido['nome'], $horarios_docentes);

                                // Verifica se um horário disponível foi encontrado e se o docente ainda não foi alocado para o número necessário de encontros semanais.
                                if ($horario_disponivel !== null && $aulas_docente_semana < $encontros_semanais) {
                                    // Adiciona o horário à lista de horários alocados para o dia atual.
                                    $horarios_alocados[$dia][] = [
                                        'disciplina' => $disciplina['nome'],
                                        'docente' => $docente_escolhido['nome'],
                                        'horario' => $horario_disponivel,
                                    ];
                                    // Atualiza o último horário alocado para o dia atual.
                                    $ultimo_horario_alocado[$dia] = $horario_disponivel;
                                    // Incrementa o contador de aulas do docente na semana.
                                    $aulas_docente_semana++;

                                    // Adiciona o horário à lista de horários ocupados do docente.
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
        // Adiciona a alocação de horários da turma atual ao indivíduo.
        $individuo[$turma] = $horarios_alocados;
    }

    // Retorna o indivíduo após todas as turmas terem sido processadas.
    return $individuo;
}
//

// Função para verificar se todas as disciplinas estão alocadas em algum horário
function todas_disciplinas_alocadas($individuo, $turmas) {
    // Inicializa um array para armazenar todas as disciplinas das turmas
    $todas_disciplinas = [];

    // Loop pelas turmas
    foreach ($turmas as $turma) {
        // Loop pelas disciplinas de cada turma
        foreach ($turma['disciplinas'] as $disciplina) {
            // Adiciona o nome da disciplina ao array de todas as disciplinas
            $todas_disciplinas[] = $disciplina['nome'];
        }
    }

    // Loop pelos horários alocados para cada turma no indivíduo
    foreach ($individuo as $turma) {
        // Loop pelos dias em cada turma
        foreach ($turma as $dia) {
            // Loop pelas aulas em cada dia
            foreach ($dia as $aula) {
                // Se a disciplina da aula atual está no array de todas as disciplinas
                if (($key = array_search($aula['disciplina'], $todas_disciplinas)) !== false) {
                    // Remove a disciplina do array de todas as disciplinas
                    unset($todas_disciplinas[$key]);
                }
            }
        }
    }

    // Se o array de todas as disciplinas está vazio, então todas as disciplinas foram alocadas
    return count($todas_disciplinas) === 0;
}
//


// Função para encontrar um horário disponível para alocar uma disciplina e um docente em particular
function encontrar_horario_disponivel($vagas_horarios, $horarios_alocados, $dia, $ultimo_horario_alocado, $docente_escolhido, $horarios_docentes)
{
    // Loop através dos horários disponíveis no dia
    foreach ($vagas_horarios as $vaga) {
        // Verifica se o dia do horário disponível é o mesmo que o dia desejado e o horário disponível é maior que o último horário alocado
        if ($vaga['dia'] === $dia && (!isset($ultimo_horario_alocado[$dia]) || $vaga['horario'] > $ultimo_horario_alocado[$dia])) {
            // Verifica se o horário já está ocupado por uma disciplina ou docente
            if (!horario_ocupado($horarios_alocados, $dia, $vaga['horario'])) {
                // Verifica se o docente não está ocupado neste horário e se o docente não está ocupado neste dia e horário, retorna o horário disponível
                if (!isset($horarios_docentes[$docente_escolhido]) || !isset($horarios_docentes[$docente_escolhido][$dia]) || !in_array($vaga['horario'], $horarios_docentes[$docente_escolhido][$dia])) {
                    return $vaga['horario'];
                }
            }
        }
    }

    // Se nenhum horário disponível for encontrado, retorna null
    return null;
}
//

// Função que verifica se um horário específico em um dia específico já está ocupado por alguma disciplina.
function horario_ocupado($horarios_alocados, $dia, $horario)
{
    if (isset($horarios_alocados[$dia])) {
        // Se existem horários alocados para o dia fornecido

        foreach ($horarios_alocados[$dia] as $alocacao) {
            // Loop por todas as alocações para o dia em questão

            if ($alocacao['horario'] == $horario) {
                // Se o horário da alocação atual é igual ao horário que esta sendo verificado

                return true;  // Então o horário está ocupado, e a função retorna true
            }
        }
    }

    // Se o horário não estava ocupado (ou não havia horários alocados para o dia fornecido), a função retorna false
    return false;
}
//

// Etapa 2: Função de Aptidão e //Etapa 5: Aplicação das Restrições (Apos aplicação das restrições)
function avaliar_aptidao($individuo, $turmas)
{
    // Inicializa o contador total de conflitos
    $total_conflitos = 0;

    // Inicializa arrays para armazenar a contagem de aulas por disciplina e por professor por dia
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
                $horario = $alocacao['horario'] ?? null;

                // Se já existe uma aula alocada para o horário, incrementa o total de conflitos
                if (isset($aulas_por_horario[$horario])) {
                    $total_conflitos++;
                }

                // Adiciona a alocação ao array de aulas por horário
                $aulas_por_horario[$horario][] = $alocacao;

                // Adiciona um conflito se o docente está indisponível no dia e horário alocado
                foreach ($turmas[$turma]['disciplinas'] as $disciplina) {
                    if ($disciplina['nome'] == $alocacao['disciplina']) {
                        foreach ($disciplina['docentes'] as $docente) {
                            if ($docente['nome'] == $alocacao['docente'] && in_array($dia, $docente['diasIndisponiveis'])) {
                                $total_conflitos++;
                            }
                        }
                    }
                }

                // Incrementa a contagem de aulas por disciplina
                $aulas_por_disciplina[$turma][$alocacao['disciplina']] = ($aulas_por_disciplina[$turma][$alocacao['disciplina']] ?? 0) + 1;
                
                // Incrementa a contagem de aulas por professor por dia
                $aulas_por_professor_por_dia[$alocacao['docente']][$dia] = ($aulas_por_professor_por_dia[$alocacao['docente']][$dia] ?? 0) + 1;
            }
        }
    }

    // Verifica se todas as disciplinas de cada turma foram alocadas o número correto de vezes
    foreach ($turmas as $turma => $info) {
        foreach ($info['disciplinas'] as $disciplina) {
            $contagem = $aulas_por_disciplina[$turma][$disciplina['nome']] ?? 0;
            if ($contagem < $disciplina['encontrosSemanais']) {
                $total_conflitos += $disciplina['encontrosSemanais'] - $contagem;
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
    // Inicializa a variável que armazenará o melhor indivíduo e a melhor aptidão encontrada com valores nulos e PHP_INT_MAX respectivamente
    $melhor_individuo = null;
    $melhor_aptidao = PHP_INT_MAX;

    // Loop por todos os indivíduos da população
    foreach ($populacao as $individuo) {
        // Avalia a aptidão do indivíduo atual usando a função avaliar_aptidao definida anteriormente
        $aptidao = avaliar_aptidao($individuo, $turmas);

        // Se a aptidão do indivíduo atual for melhor (ou seja, menor, já que estamos tentando minimizar o número de conflitos) do que a melhor aptidão encontrada até o momento,
        // então atualiza a melhor aptidão e o melhor indivíduo
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
// Função que cria a população inicial
function criar_populacao_inicial($turmas, $tamanho_populacao)
{
    // Inicializa um array vazio para armazenar a população
    $populacao = [];

    // Loop pelo número especificado de vezes para criar indivíduos
    for ($i = 0; $i < $tamanho_populacao; $i++) {
        // Cria um novo indivíduo usando a função individuo
        $individuo = individuo($turmas);
        // Adiciona o indivíduo à população
        $populacao[] = $individuo;
    }

    // Retorna a população completa
    return $populacao;
}
//

// Etapa 4: Operadores Genéticos
// Função que realiza a seleção por torneio de indivíduos da população
function selecao_torneio($populacao, $k, $turmas)
{
    // Seleciona k índices aleatórios da população
    $indices_selecionados = array_rand($populacao, $k);

    // Inicializa um array para armazenar os indivíduos selecionados com suas aptidões
    $selecionados = [];
    foreach ($indices_selecionados as $indice) {
        // Cria uma entrada para o indivíduo atual e sua aptidão
        $selecionados[] = [
            'individuo' => $populacao[$indice],
            'aptidao' => avaliar_aptidao($populacao[$indice], $turmas),
        ];
    }

    // Ordena os selecionados pela aptidão em ordem crescente
    usort($selecionados, function ($a, $b) {
        // Função de comparação para usort que compara a aptidão dos indivíduos
        return $a['aptidao'] - $b['aptidao'];
    });

    // Retorna os dois melhores indivíduos (os dois primeiros após a ordenação)
    // Esses são os vencedores do torneio
    return [$selecionados[0]['individuo'], $selecionados[1]['individuo']];
}
//

// Crossover de um ponto: seleciona um ponto aleatório e troca as partes dos dois pais
// Função que realiza um crossover de um ponto entre dois pais
function crossover_um_ponto($pai1, $pai2)
{

    // Seleciona um ponto aleatório ao longo dos pais
    $ponto = rand(0, count($pai1) - 1);

    // Cria o primeiro filho copiando a parte inicial do primeiro pai e a parte final do segundo pai
    $filho1 = array_merge(array_slice($pai1, 0, $ponto), array_slice($pai2, $ponto));

    // Cria o segundo filho copiando a parte inicial do segundo pai e a parte final do primeiro pai
    $filho2 = array_merge(array_slice($pai2, 0, $ponto), array_slice($pai1, $ponto));

    // Retorna os dois filhos
    return [$filho1, $filho2];
}
//

// Função que realiza uma mutação por troca em um indivíduo
function mutacao_troca($individuo, $turmas)
{
    // Seleciona aleatoriamente uma turma dentro do indivíduo
    $turma = array_rand($individuo);

    // Verifica se a turma selecionada tem pelo menos dois dias com horários alocados. Se não tiver, a função retorna o indivíduo sem fazer nenhuma alteração.
    if (count($individuo[$turma]) >= 2) {
        // Se a turma selecionada tem pelo menos dois dias com horários alocados, a função seleciona dois desses dias aleatoriamente.
        $dias = array_rand($individuo[$turma], 2);

        // Verifica se cada um dos dias selecionados tem pelo menos um horário alocado. Se não tiverem, a função retorna o indivíduo sem fazer nenhuma alteração.
        if(count($individuo[$turma][$dias[0]]) > 0 && count($individuo[$turma][$dias[1]]) > 0) {
            // Se cada um dos dias selecionados tem pelo menos um horário alocado, a função seleciona aleatoriamente um horário de cada dia.
            $horario1 = array_rand($individuo[$turma][$dias[0]]);
            $horario2 = array_rand($individuo[$turma][$dias[1]]);

            // Verifica se a troca desses horários seria válida. Verifica se a troca faria com que algum professor tivesse que dar duas aulas ao mesmo tempo, o que não seria permitido.
            $docente1 = $individuo[$turma][$dias[0]][$horario1]['docente'];
            $docente2 = $individuo[$turma][$dias[1]][$horario2]['docente'];

            if(!horario_ocupado($individuo, $dias[1], $horario2, $docente1) && !horario_ocupado($individuo, $dias[0], $horario1, $docente2)) {
                // Se a troca for válida, a função realiza a troca de horários.
                $temp = $individuo[$turma][$dias[0]][$horario1];
                $individuo[$turma][$dias[0]][$horario1] = $individuo[$turma][$dias[1]][$horario2];
                $individuo[$turma][$dias[1]][$horario2] = $temp;
            }
        }
    }

    // A função então retorna o indivíduo modificado (ou não) pela mutação.
    return $individuo;
}
// 

// Execução
$tamanho_populacao = 8;  // Define o tamanho da população
$inicio = time();  // Marca o início da execução do algoritmo
$limite = 10 * 60;  // Limite de tempo de execução do algoritmo em segundos (10 minutos)

// Criação da população inicial
$populacao = criar_populacao_inicial($turmas, $tamanho_populacao);  // Cria uma população inicial aleatória de horários de aulas

// Inicializa a melhor aptidão com o maior valor possível e a contagem de gerações sem melhora com 0
$melhor_aptidao = PHP_INT_MAX;
$geracoes_sem_melhora = 0;

// Inicia o loop do algoritmo genético. O loop continuará enquanto a melhor aptidão for maior que 0, o tempo de execução não tiver excedido o limite e o número de gerações sem melhora for menor que 100
while ($melhor_aptidao > 0 && time() - $inicio < $limite && $geracoes_sem_melhora < 100) {
    
    // Avalia a aptidão de cada indivíduo (horário de aula) na população
    $aptidoes = [];
    foreach ($populacao as $individuo) {
        $aptidoes[] = avaliar_aptidao($individuo, $turmas);  // Avalia a aptidão do indivíduo atual e a adiciona à lista de aptidões
    }

    // Verifica se a melhor aptidão da população atual é melhor que a melhor aptidão encontrada até agora
    $melhor_aptidao_atual = min($aptidoes);  // Obtém a melhor aptidão da população atual
    if ($melhor_aptidao_atual < $melhor_aptidao) {  // Se a melhor aptidão atual for menor que a melhor aptidão encontrada até agora
        $melhor_aptidao = $melhor_aptidao_atual;  // Atualiza a melhor aptidão
        $geracoes_sem_melhora = 0;  // Reinicia a contagem de gerações sem melhora
    } else {  // Se a melhor aptidão atual não for menor que a melhor aptidão encontrada até agora
        $geracoes_sem_melhora++;  // Incrementa a contagem de gerações sem melhora
    }

    // Executa a seleção por torneio, selecionando 2 pais da população
    $pais = selecao_torneio($populacao, 2, $turmas);

    // Executa o crossover de um ponto nos pais selecionados para gerar filhos
    $filhos = crossover_um_ponto($pais[0], $pais[1]);

    // Realiza a mutação por troca nos filhos gerados
    for ($i = 0; $i < count($filhos); $i++) {
        $filhos[$i] = mutacao_troca($filhos[$i], $turmas);
    }

    // Verifica se todas as disciplinas estão alocadas em cada filho. Se uma disciplina não estiver alocada, realiza uma mutação no filho
    for ($i = 0; $i < count($filhos); $i++) {
        if (!todas_disciplinas_alocadas($filhos[$i], $turmas)) {
            $filhos[$i] = mutacao_troca($filhos[$i], $turmas);
        }
    }

    // Define o percentual da população que será substituído pelos novos filhos
    $percentual_substituicao = 0.3;
    $quantidade_substituir = round($tamanho_populacao * $percentual_substituicao);

    // Ordena a população pela aptidão dos indivíduos
    usort($populacao, function ($a, $b) use ($turmas) {
        return avaliar_aptidao($a, $turmas) <=> avaliar_aptidao($b, $turmas);
    });

    // Substitui os piores indivíduos da população pelos filhos
    for ($i = 0; $i < $quantidade_substituir; $i++) {
        $populacao[$tamanho_populacao - $i - 1] = $filhos[$i];
    }

    // Reordena a população pela aptidão dos indivíduos
    usort($populacao, function ($a, $b) use ($turmas) {
        return avaliar_aptidao($a, $turmas) <=> avaliar_aptidao($b, $turmas);
    });

    // Limita o tamanho da população ao tamanho inicialmente definido, descartando os piores indivíduos se a população for maior que o tamanho definido
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
