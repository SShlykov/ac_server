<template>
  <div>
    <img :src="item.photo" :alt="item.name + item.id" class="card-img-top" />
    <h3>Водитель {{item.name + " " + item.last_name}}</h3>
    <p>Находится в {{item.locale}}</p>
    <p>Телефон - {{item.phone}}</p>
    <button @click="deleteItem(item.id)" class="btn btn-danger">Удалить</button>
    <a :href="'driver/'+item.id" class="btn btn-outline-primary ml-4">К водителю</a>
  </div>
</template>

<script>
export default {
  name: "DriverCard",
  props: {
    item: {
      required: true
    },
    deleteItem: {
      required: true
    }
  },
  methods: {
    redirectToItem() {}
  }
};
</script>
