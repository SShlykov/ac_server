<template>
  <div class="w-100">
    <section class="d-flex justify-content-center">
      <button
        type="button"
        @click.prevent="changeViewContent('Planning')"
        class="btn btn-outline-dark"
      >Спланировать тур</button>
      <button
        @click.prevent="changeViewContent('About')"
        type="button"
        class="btn btn-outline-dark ml-2"
      >О нас</button>
    </section>

    <section v-if="contentFlag=='Planning'">Planning</section>
    <section v-if="contentFlag=='About'">About</section>
  </div>
</template>

<script>
export default {
  name: "ContentValue",
  components: {},
  data() {
    return {
      data: {
        item: {},
        fields: {},
        list: {}
      },
      contentFlag: "Planning",
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
    },
    changeViewContent(item) {
      this.contentFlag = item;
    }
  }
};
</script>
