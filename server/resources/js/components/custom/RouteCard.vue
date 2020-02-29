<template>
  <div>
    <h3>Точка {{item.name}}</h3>
    <p>Широта: {{item.latitude}}</p>
    <p>Долгота: {{item.longitude}}</p>
    <a class="btn btn-primary" :href="'/home/route/' + item.id">Показать точку</a>
    <a @click="deleteRoute(item.id)" class="btn btn-outline-dark ml-2" href="#">Скрыть точку</a>
  </div>
</template>

<script>
export default {
  name: "RouteCard",
  props: {
    item: {
      required: true
    },
    destroyItem: {
      required: true
    },
    fetchData: {
      required: false
    }
  },
  methods: {
    deleteRoute(id) {
      if (confirm("Вы точно хотите удалить точку?")) {
        fetch(`/api/route/` + id, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert(`Точка удалена`);
            this.fetchData();
          })
          .catch(err => console.log(err));
      }
      this.fetchData();
    }
  }
};
</script>


