<template>
<div>
    <img :src="item.photo" :alt="'driver-' + item.id" class="card-img-top">
    <h3>Водитель {{item.name + " " + item.last_name}}</h3>
    <p>Находится в {{item.locale}}</p>
    <p>Телефон - {{item.phone}}</p>
    <button @click="deleteItem(item.id)" class="btn btn-danger">Delete</button>
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
    }
  }
</script>

<style scoped>

</style>
