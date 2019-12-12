new Vue({
    el: '#app',
    data: {
        status: {

        },
        playing: false,
        maxHeal: 10,
        maxSpecialHitPlayer: 12,
        minHit: 5,
        maxHitPlayer: 8,
        maxHitMonster: 10,
        playerLife: 100,
        monsterLife: 100,
        logs: []
    },
    computed: {
        endGame() {
            return this.playerLife === 0 || this.monsterLife === 0;
        },
        getPlayerLifeBarColor() {
            return this.calcLifeBarColor(this.playerLife);
        },
        getMonsterLifeBarColor() {
            return this.calcLifeBarColor(this.monsterLife);
        }
    },
    methods: {
        calcLifeBarColor(life) {
            return life >= 80 ? '#218838' : (life >= 30 ? '#FFC107' : '#DC3545');
        },
        attack: function (maxHitPlayer, maxHitMonster) {
            const playerHit = this.minHit + parseInt(Math.random() * (maxHitPlayer-this.minHit));
            const monsterHit = this.minHit + parseInt(Math.random() * (maxHitMonster-this.minHit));
            this.playerLife -= monsterHit;
            this.monsterLife -= playerHit;
            this.logs.push({
                round: [
                    {
                        message: `O jogador levou ${monsterHit} de dano!`,
                        color: 'danger'
                    },
                    {
                        message: `O monstro levou ${playerHit} de dano!`,
                        color: 'success'
                    }
                ]

            });
        },
        heal: function () {
            const playerHeal = parseInt(Math.random() * this.maxHeal);
            const monsterHit = parseInt(Math.random() * this.maxHitMonster);
            this.playerLife -= monsterHit;
            this.playerLife += playerHeal;
            this.logs.push({
                round: [
                    {
                        message: `O jogador levou ${monsterHit} de dano!`,
                        color: 'danger'
                    },
                    {
                        message: `O jogador ganhou ${playerHeal} de vida!`,
                        color: 'success'
                    }
                ]

            });
        },
        resetGame: function () {
            this.playerLife = 100;
            this.monsterLife = 100;
            this.logs = [];
            this.playing = true;
        }
    },
    watch: {
        playerLife() {
            if (this.playerLife < 0) {
                this.playerLife = 0;
                this.playing = false;
            }
            if (this.playerLife > 100) this.playerLife = 100;
            if (this.monsterLife < 0) {
                this.monsterLife = 0;
                this.playing = false;
            }
        }
    }
})