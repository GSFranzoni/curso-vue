export default {
    data: function () {
        return {
            questions: [
                {
                    text: 'Qual é o coletivo de cães?',
                    options: [
                        { id: 1, text: 'MATILHA', correct: true },
                        { id: 2, text: 'REBANHO', correct: false },
                        { id: 3, text: 'CARDUME', correct: false },
                        { id: 4, text: 'MANADA', correct: false }
                    ]
                },
                {
                    text: 'Qual é a maior floresta do planeta?',
                    options: [
                        { id: 1, text: 'NEGRA', correct: false },
                        { id: 2, text: 'DE SHERWOOD', correct: false },
                        { id: 3, text: 'DA TIJUCA', correct: false },
                        { id: 4, text: 'AMAZÔNICA', correct: true }
                    ]
                },
                {
                    text: 'Quem é o primeiro substituto do Presidente?',
                    options: [
                        { id: 1, text: 'VEREADOR', correct: false },
                        { id: 2, text: 'VICE-PRESIDENTE', correct: true },
                        { id: 3, text: 'SENADOR', correct: false },
                        { id: 4, text: 'DEPUTADO', correct: false }
                    ]
                },
                {
                    text: 'Segundo o romance, que animal era “Moby Dick”?',
                    options: [
                        { id: 1, text: 'TUBARÃO', correct: false },
                        { id: 2, text: 'GOLFINHO', correct: false },
                        { id: 3, text: 'POLVO', correct: false },
                        { id: 4, text: 'BALEIA', correct: true }
                    ]
                },
                {
                    text: 'Que animal é o Pateta?',
                    options: [
                        { id: 1, text: 'CAVALO', correct: false },
                        { id: 2, text: 'BURRO', correct: false },
                        { id: 3, text: 'CACHORRO', correct: true },
                        { id: 4, text: 'RAPOSA', correct: false }
                    ]
                },
                {
                    text: 'Qual destes personagens não veste uma capa?',
                    options: [
                        { id: 1, text: 'SUPER-HOMEM', correct: false },
                        { id: 2, text: 'BATMAN', correct: false },
                        { id: 3, text: 'WOLVERINE', correct: true },
                        { id: 4, text: 'ZORRO', correct: false }
                    ]
                },
            ]
        }
    }
}