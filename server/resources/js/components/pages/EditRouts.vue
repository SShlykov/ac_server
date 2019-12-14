<template>
  <div>
    <a class="btn btn-dark" href="/home/routes">Назад</a>
    <button
      @click.prevent="toggleGroup()"
      v-if="!newGroup"
      class="btn btn-primary ml-3"
    >Новая группа</button>
    <div v-if="newGroup" class="rout_container rout_container_edit-routs">
      <input
        v-model="data.item['name']"
        class="main_input"
        type="text"
        placeholder="Название группы"
      />
      <button @click.prevent="route_group_post()" class="btn btn btn-primary ml-3">Добавить</button>
      <button @click.prevent="toggleGroup()" class="btn btn-outline-dark ml-3">Отменить</button>
    </div>
    <div class="d-flex flex-wrap">
      <RouteGroupCard
        v-for="item in this.data.list"
        v-bind:key="key_random(item)"
        :fetchData="fetchData"
        :name="item.name"
        :id="item.id"
      ></RouteGroupCard>
    </div>
  </div>
</template>

<script>
import RouteGroupCard from "../custom/RoutGroupCard";
export default {
  name: "EditRouts",
  components: {
    RouteGroupCard
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
