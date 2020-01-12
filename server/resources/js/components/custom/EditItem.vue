<template>
  <div class="routs_item_width">
    <div v-if="!editItem">{{ name }}</div>
    <input v-model="item.name" v-if="editItem" type="text" class="main_input" />
    <button
      v-if="!editItem"
      class="btn btn-outline-primary ml-3"
      @click.prevent="toggleEditItem"
    >Редактировать</button>
    <button
      v-if="editItem"
      class="btn btn-outline-primary ml-3"
      @click.prevent="updateItem"
    >Сохранить</button>
    <button
      v-if="editItem"
      class="btn btn-outline-dark ml-3"
      @click.prevent="toggleEditItem"
    >Отменить</button>
  </div>
</template>

<script>
export default {
  name: "EditItem",
  props: {
    name: {
      required: true
    },
    id: {
      required: true
    },
    urlupdate: {
      required: true
    },
    update_i: {
      required: true
    }
  },
  data() {
    return {
      item: {
        id: "",
        name: ""
      },
      editItem: false
    };
  },
  async created() {
    this.item.id = this.id;
    this.item.name = this.name;
  },
  methods: {
    toggleEditItem() {
      this.editItem = !this.editItem;
    },
    async updateItem() {
      await fetch(this.urlupdate, {
        method: "put",
        body: JSON.stringify(this.item),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {})
        .catch(err => console.log(err));

      this.toggleEditItem();
      this.update_i();
    }
  }
};
</script>


