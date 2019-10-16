<template>
    <div>
        <h3>Точка {{item.name}}</h3>
        <p>Широта: {{item.latitude}}</p>
        <p>Долгота: {{item.longitude}}</p>
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
  }
</script>
