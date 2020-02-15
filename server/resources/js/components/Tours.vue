<template>
  <div class="page_container">
    <h2 class="tour_title">Управление турами</h2>
    <AddTour :tourName="'Название тура'" :updateItem="getCategories" class="mb-4"></AddTour>
    <tour
      v-for="item in tourItems.slice().reverse()"
      :id="item.id"
      :name="item.name"
      :image="item.image"
      :time="item.time"
      :updateItem="getCategories"
      v-bind:key="random(item)"
    ></tour>
  </div>
</template>

<script>
import Tour from "./custom/Tour.vue";
import AddTour from "./custom/AddTour.vue";

export default {
  name: "Tours",
  components: {
    Tour,
    AddTour
  },
  data() {
    return {
      tourItems: []
    };
  },
  async created() {
    await this.getCategories();
  },
  methods: {
    async getCategories() {
      await fetch(`/api/alltour`)
        .then(res => res.json())
        .then(res => (this.tourItems = res.data))
        .catch(err => console.log(err));
    },
    random(item) {
      return Math.random();
    }
  }
};

//<tour :tour_disabled_up="'tour_disabled'"></tour>
//<tour :tour_disabled_down="'tour_disabled'"></tour>
</script>
