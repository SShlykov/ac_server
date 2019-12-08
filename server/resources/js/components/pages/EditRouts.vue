<template>
  <div>
    <a class="btn btn-dark" href="/home/routes">Назад</a>
    <button
      @click.prevent="toggleGroup()"
      v-if="!newGroup"
      class="btn btn-primary ml-3"
    >Новая группа</button>
    <div v-if="newGroup" class="rout_container rout_container_edit-routs">
      <input class="main_input" type="text" placeholder="Название группы" />
      <button @click.prevent="toggleGroup()" class="btn btn btn-primary ml-3">Добавить</button>
      <button @click.prevent="toggleGroup()" class="btn btn-outline-dark ml-3">Отменить</button>
    </div>
    <div class="d-flex flex-wrap">
      <RouteGroupCard :name="'Кош - Агач'"></RouteGroupCard>
      <RouteGroupCard :name="'Новосибирск'"></RouteGroupCard>
      <RouteGroupCard :name="'Усть - Кокса'"></RouteGroupCard>
      <RouteGroupCard :name="'Чоя'"></RouteGroupCard>
      <RouteGroupCard :name="'Турочак'"></RouteGroupCard>
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
      newGroup: false
    };
  },
  props: {},
  methods: {
    toggleGroup() {
      this.newGroup = !this.newGroup;
    }
  }
};
</script>
