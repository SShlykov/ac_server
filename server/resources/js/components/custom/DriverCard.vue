<template>
  <div>
    <figure class="driver-card-figure">
      <img :src="item.photo" :alt="item.name + item.id" class="card-img-top" />
    </figure>
    <h3>Водитель {{item.name + " " + item.last_name}}</h3>
    <p>Находится в {{item.locale}}</p>
    <p>Телефон - {{item.phone}}</p>

    <a :href="'/home/driver/'+item.id" class="btn btn-primary ml-2">К водителю</a>

    <button @click="destroyItem(item.id)" class="btn btn-outline-dark ml-2">Удалить</button>
    <button @click="deleteItem(item.id)" class="btn btn-outline-dark ml-2">Скрыть</button>
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
    },
    destroyItem: {
      required: true
    }
  },
  methods: {
    redirectToItem() {}
  }
};
</script>

