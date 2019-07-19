<template>
    <div>
        <div v-show="(this.current_Round.order_number !== this.round.order_number) && (this.round.title != null)">
            <h5 class="text-muted"> {{this.round.title}} </h5>
        </div>
        <div v-show="this.current_Round.order_number === this.round.order_number">
            <b-form  @submit.stop.prevent>
                <b-input
                        v-model="round_Title"
                        placeholder="Round Title"
                        :state="null"
                        id="feedbacek-user"
                        size="sm"
                        v-if="validation">
                </b-input>
                <b-input
                        v-model="round_Title"
                        placeholder="Round Title"
                        :state="validation"
                        id="feedback-user"
                        size="sm"
                        v-if="!validation">

                </b-input>
                <b-form-invalid-feedback :state="validation">
                    Cannot be longer than 20 characters.
                </b-form-invalid-feedback>
            </b-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "round-edit-title-time"
    }
</script>

<style scoped>

</style>