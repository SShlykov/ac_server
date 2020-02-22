<template>
  <div>
    <div v-if="!editCard" class="routgroup">
      <div class="routgroup_name">{{ name }}</div>
      <button @click.prevent="toggleEditCard" class="btn btn-outline-primary ml-3">Изменить</button>
      <button @click.prevent="route_group_delete" class="btn btn-outline-danger ml-3">Удалить</button>
    </div>
    <div class="routgroup flex-column" v-if="editCard">
      <div class="d-flex flex-wrap justify-content-center w-100">
        <AutoInput
          :inputText="new_item.route_name"
          class="mb-2"
          :items="allNameRoutes"
          :returnData="getInput"
        ></AutoInput>
        <button class="ml-4 btn btn-outline-success" @click.prevent="rout_group_add_rout">добавить</button>
      </div>
      <RouteItem
        v-for="item in routes"
        v-bind:key="random(item)"
        :route_id="id"
        :id="item.id"
        :name="item.name"
        :getRouts="getRouts"
        :purpose="'routegroups'"
      ></RouteItem>
      <div class="d-flex .align-items-center">
        <button @click.prevent="toggleEditCard" class="ml-3 btn btn-outline-dark mt-3">Назад</button>
      </div>
    </div>
  </div>
</template>

<script>
import RouteItem from "../custom/RouteItem";
import AutoInput from "../custom/AutoInput";

export default {
  name: "RoutGroupCard",
  components: {
    RouteItem,
    AutoInput
  },
  data() {
    return {
      editCard: false,
      routes: {},
      new_item: {
        route_group_id: "",
        route_name: ""
      }
    };
  },
  props: {
    name: {
      required: true
    },
    id: {
      required: true
    },
    fetchData: {
      required: true
    },
    allNameRoutes: {
      required: true
    }
  },
  async created() {
    await this.getRouts();
    this.new_item.route_group_id = this.id;
  },
  methods: {
    async getRouts() {
      console.log("Front id :" + this.id);
      await fetch(`/api/route_group/show_connected/` + this.id)
        .then(res => res.json())
        .then(res => {
          this.routes = res;
          console.log("Take data :" + res);
        })
        .catch(err => console.log(err));
    },
    toggleEditCard() {
      this.editCard = !this.editCard;
    },
    async route_group_delete() {
      if (confirm("Вы точно хотите удалить?")) {
        fetch(`/api/route_group/` + this.id, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            this.fetchData();
            alert(`Выполнено`);
          })
          .catch(err => console.log(err));
      }
    },
    random(item) {
      return Math.random();
    },
    async rout_group_add_rout() {
      console.log(this.new_item.route_name);
      await fetch(`/api/route_group/connect`, {
        method: "post",
        body: JSON.stringify(this.new_item),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`добавлен`);
          this.getRouts();
          this.new_item.route_name = "";
        })
        .catch(err => console.log(err));
    },
    getInput(item) {
      this.new_item.route_name = item;
    }
  }
};
</script>
