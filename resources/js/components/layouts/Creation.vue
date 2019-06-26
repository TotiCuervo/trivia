<template>

    <div class="creation">
        <div class="creation-nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="/home"><i class="fas fa-times-circle fa-2x"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content py-4">
            <div class="container">

                <div v-if="order === 0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="game-header">
                                <div class="float-right">
                                    <button type="button" class="btn"><i class="far fa-edit fa-2x"></i></button>
                                </div>
                                <h1>{{ game.name }}</h1>

                                <div v-if="game.description">
                                    <h3 class="text-muted">
                                        {{ game.description }}
                                    </h3>
                                </div>
                                <div v-else>
                                    <h3 class="text-muted">
                                        Edit to add Description
                                    </h3>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>


                <div v-if="order === 4">
                    <CreateName v-on:triggeredEvent="setGame"></CreateName>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                order: 4,
                game: null,
            }
        },
        methods: {
            toggleNum(){
                this.number+=1
            },
            setGame(data)
            {
                console.log(data);
                this.game = data;
                this.changeOrder(0);
            },
            changeOrder(newOrder)
            {
                this.order = newOrder;
            },
        }
    }
</script>

<style scoped>

</style>