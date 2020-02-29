<template>
  <div>
    <div class="d-flex align-items-center">
      <a class="btn btn-dark" href="/home/routes">Назад</a>
      <NewRouteGroup :fetchData="fetchData" class="ml-3"></NewRouteGroup>
    </div>
    <div class="d-flex flex-wrap">
      <RouteGroupCard
        v-for="item in this.data.list"
        v-bind:key="key_random(item)"
        :fetchData="fetchData"
        :name="item.name"
        :id="item.id"
        :allNameRoutes="allNameRoutes"
      ></RouteGroupCard>
    </div>
  </div>
</template>

<script>
import RouteGroupCard from "../custom/RoutGroupCard";
import NewRouteGroup from "../custom/NewRouteGroup";

export default {
  name: "EditRouts",
  components: {
    RouteGroupCard,
    NewRouteGroup
  },
  data() {
    return {
      data: {
        item: {},
        fields: {},
        list: {}
      },
      newGroup: false,
      allRoutes: [],
      allNameRoutes: []
    };
  },
  props: {},
  async created() {
    await this.fetchData();
    await this.getAllRoutes();
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
    async getAllRoutes() {
      await fetch(`/api/route/routes/all`)
        .then(res => res.json())
        .then(res => {
          this.allRoutes = res.data;
          console.log("Take data :" + res);
        })
        .catch(err => console.log(err));
      this.allNameRoutes = this.allRoutes.map(x => x.name);
      console.log(this.allRoutes);
    },
    route_group_post() {
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

    getInput(item) {
      this.text = item;
    }
  }
};
</script>
