<template>
  <div>
    <div v-if="!editCard" class="routgroup">
      <div class="routgroup_name">{{name}}</div>
      <button @click.prevent="toggleEditCard" class="btn btn-outline-primary ml-3">Изменить</button>
      <button class="btn btn-outline-danger ml-3">Удалить</button>
    </div>
    <div class="routgroup flex-column" v-if="editCard">
      <div class="v-flex flex-nowrap w-10">
        <input class="main_input" type="text" placeholder="Название точки" />
        <button class="ml-4 btn btn-outline-success">добавить</button>
      </div>
      <RouteItem :name="'Krajcikborough'"></RouteItem>
      <RouteItem :name="'Douglasport'"></RouteItem>
      <button @click.prevent="toggleEditCard" class="btn btn-outline-primary mt-3">Сохранить</button>
    </div>
  </div>
</template>

<script>
import RouteItem from "../custom/RouteItem";
export default {
  name: "RoutGroupCard",
  components: {
    RouteItem
  },
  data() {
    return {
      editCard: false
    };
  },
  props: {
    name: {
      required: true
    }
  },
  methods: {
    toggleEditCard() {
      this.editCard = !this.editCard;
    }
  }
};
</script>