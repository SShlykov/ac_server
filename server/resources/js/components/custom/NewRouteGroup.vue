<template>
  <div>
    <button @click.prevent="toggleEdit()" v-if="!editRout" class="btn btn-primary ml-3">Новая группа</button>
    <div v-if="editRout" class="rout_container rout_container_edit-routs">
      <input v-model="text" class="main_input" type="text" placeholder="Название группы" />
      <button @click.prevent="route_group_post()" class="btn btn btn-primary ml-3">Добавить</button>
      <button @click.prevent="toggleEdit()" class="btn btn-outline-dark ml-3">Отменить</button>
    </div>
  </div>
</template>

<script>
import AutoInput from "../custom/AutoInput";

export default {
  name: "NewRouteGroup",
  components: { AutoInput },
  props: {
    fetchData: {
      required: true
    }
  },
  data() {
    return {
      editRout: false,
      text: ""
    };
  },
  methods: {
    toggleEdit() {
      this.editRout = !this.editRout;
    },
    route_group_post() {
      fetch(`/api/route_group/`, {
        method: "POST",
        body: JSON.stringify({
          name: this.text
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