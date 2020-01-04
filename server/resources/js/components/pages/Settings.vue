<template>
    <div class="w100">
        <section>
            <button type="button" class="btn btn-outline-dark">Туры</button>
            <button type="button" class="btn btn-outline-dark">О нас</button>
            <button type="button" class="btn btn-outline-dark">Иконки</button>
        </section>

        <AutoInput></AutoInput>

        <section>content</section>
    </div>
</template>

<script>
import AutoInput from "../custom/AutoInput.vue";

export default {
    name: "ContentValue",
    components: {
        AutoInput
    },
    data() {
        return {
            data: {
                item: {},
                fields: {},
                list: {}
            },
            newGroup: false
        };
    },
    props: {},
    async created() {
        await this.fetchData();
        console.log(this.data.list);
    },
    methods: {
        async fetchData() {
            await fetch("/api/route_group/groups")
                .then(res => res.json())
                .then(res => {
                    this.data.list = res.data;
                })
                .catch(err => console.warn(err));
        },
        toggleGroup() {
            this.newGroup = !this.newGroup;
        },
        key_random(item) {
            return Math.random() * Math.random();
        },
        route_group_post() {
            console.log(this.data.item.name);
            fetch(`/api/route_group/`, {
                method: "POST",
                body: JSON.stringify({
                    name: this.data.item.name
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            })
                .then(res => res.json())
                .then(data => {
                    console.log(`Группа создана`);
                    this.fetchData();
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
