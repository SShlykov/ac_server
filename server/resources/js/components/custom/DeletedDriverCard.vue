<template>
  <div>
    <img :src="item.photo" :alt="item.name + item.id" class="card-img-top" />
    <h3>Водитель {{item.name + " " + item.last_name}}</h3>
    <p>Находится в {{item.locale}}</p>
    <p>Телефон - {{item.phone}}</p>
    <button @click="restoreItem(item.id)" class="btn btn-primary ml-2">Восстановить</button>
    <button @click="destroyItem(item.id)" class="btn btn-outline-dark ml-2">Удалить</button>
  </div>
</template>

<script>
export default {
  name: "DriverCard",
  props: {
    item: {
      required: true
    },
    destroyItem: {
      required: true
    },
    restoreItem: {
      required: true
    }
  },
  methods: {
    redirectToItem() {}
  }
};
</script>
