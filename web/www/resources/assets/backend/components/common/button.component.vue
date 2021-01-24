<template>
    <a v-if="btn"
       :href="btn.type === 'link' ? btn.link : 'javascript:void(0)'"
       :data-toggle="btn.type"
       :data-target="btn.type === 'modal'? '#'+btn.modal_id : false"
       v-on:click="buttonAction($event)">
        <img :src="this.asset('/img/'+ btn.icon + '.png')" :alt="btn.name" width="25">
        {{btn.name && this.getLang(btn.name)}}
    </a>
</template>

<script>

export default {
    name: "button.component",
    props: ['btn', 'action'],
    methods: {
        buttonAction(event) {
            const button = {
                modal: {
                    id: _.get(this.btn, 'modal_id', null),
                    title: this.getLang(this.btn.name),
                    button: ''
                },
                event,
            };
            this.action(button);
        }
    }
}
</script>

<style scoped>

</style>
