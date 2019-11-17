<template>
  <div>
    <h3>Точка {{item.name}}</h3>
    <p>Широта: {{item.latitude}}</p>
    <p>Долгота: {{item.longitude}}</p>
    <a class="btn btn-primary" :href="'/home/route/' + item.id">Показать точку</a>
    <a class="btn btn-outline-dark ml-2" href="#">Скрыть точку</a>
  </div>
</template>

<script>
export default {
  name: "RouteCard",
  props: {
    item: {
      required: true
    }
  }
};
</script>
